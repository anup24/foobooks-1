#!/bin/sh

#
# Customize the following for your project/server
#
docRoot="/var/www/html/foobooks"
usernameServer="root@104.236.208.248"


# Helper output functions
line () {
    info "--------------------------------------"
}

info () {
    echo $(tput bold)$(tput setaf 4)$@ $(tput sgr 0)
}


# Function to handle git actions locally
welcome () {
    info "Running git status:"
    line
    git status
    line
    info "How would you like to proceed?"
    info " (1) Push and deploy any pending commits."
    info " (2) Stage and commit all changed files, then push and deploy any pending commits."
    info " (3) Exit"
    info "Enter your choice: "
    read -${BASH_VERSION+e}r choice

     case $choice in
        1)
            ssh -t $usernameServer "$docRoot/bash/deploy.sh"
            ;;
        2)
            info "Enter a commit message: "
            read -${BASH_VERSION+e}r msg
            line
            git add --all
            git commit -m "$msg"
            git push origin master
            line
            ssh -t $usernameServer "$docRoot/bash/deploy.sh"
            ;;
        3)
            info "Ok, goodbye!";
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
    info 'git pull origin master:'
    line
    git pull origin master
    line
    info 'composer install --no-dev:'
    line
    composer install --no-dev
    line
}


# If this script is run on the server (docRoot exists), it should deploy
if [ -d "$docRoot" ]; then
    info 'Detected location: Server - Running deployment.'
    deploy
# Otherwise, if this script is run locally,
# it should invoke `welcome` to determine whether to deploy
else
    info 'Detected location: Local'
    welcome
fi