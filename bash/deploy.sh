#!/bin/sh

#
# Customize the following for your project/server
#
docRoot="/var/www/html/foobooks"
usernameServer="root@server.ip.address"


# Helper function to output a line separator
line () {
    echo "--------------------------------------"
}

cecho() {
  local code="\033["
  case "$1" in
    black  | bk) color="${code}0;30m";;
    red    |  r) color="${code}1;31m";;
    green  |  g) color="${code}1;32m";;
    yellow |  y) color="${code}1;33m";;
    blue   |  b) color="${code}1;34m";;
    purple |  p) color="${code}1;35m";;
    cyan   |  c) color="${code}1;36m";;
    gray   | gr) color="${code}0;37m";;
    *) local text="$1"
  esac
  [ -z "$text" ] && local text="$color$2${code}0m"
  echo "$text"
}



# Function to show a `git status` on server and prompts for whether to deploy or not
# This function is invoked when this script is run on your local machine.
welcome () {
    cecho b "Running git status:"
    git status
    cecho b "\nHow would you like to proceed?"
    cecho b "    (1) Stage and commit all changed files, then push and deploy."
    cecho b "    (2) Push and deploy any pending commits."
    cecho b "    (3) Exit"
    cecho b "Enter your choice:"
    read -${BASH_VERSION+e}r choice

     case $choice in
        1)
            echo "Enter a commit message: "
            read -${BASH_VERSION+e}r msg
            git add --all
            git commit -m "$msg"
            git push origin master
            ssh $usernameServer "$docRoot/bash/deploy.sh"
            ;;
        2)
            ssh $usernameServer "$docRoot/bash/deploy.sh"
            ;;
        3)
            echo "Ok, goodbye!";
            exit
            ;;
        *)
            echo "Unknown command";
            ;;
    esac

    line
    echo "Git status on server for $docRoot:"
    ssh $usernameServer "cd $docRoot; git status"
    line
    echo "Do you want to continue with deployment? (y/n)"

    read -${BASH_VERSION+e}r choice

    case $choice in
        y)
            ssh $usernameServer "$docRoot/bash/deploy.sh"
            ;;
        n)
            echo "Ok, goodbye!";
            exit
            ;;
        *)
            echo "Unknown command";
            ;;
    esac
}


# Function to deploy: pull changes, run composer install
# This function is invoked when this script is invoked on your server
deploy () {
    cd $docRoot;
    line
    echo 'git pull origin master:'
    git pull origin master
    line
    echo 'composer install --no-dev:'
    composer install --no-dev
}


# If this script is run on the server (docRoot exists), it should deploy
if [ -d "$docRoot" ]; then
    echo 'Detected location: Server - Running deployment.'
    deploy
# Otherwise, if this script is run locally,
# it should invoke `welcome` to determine whether to deploy
else
    echo 'Detected location: Local'
    welcome
fi
