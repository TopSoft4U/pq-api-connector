#!/bin/bash

# Ensure correct parameters
if [ "$#" -ne 1 ] || [[ ! "$1" =~ ^(patch|minor|major)$ ]]; then
    echo "You must supply a single argument (patch, minor, or major) for script execution."
    exit 1
fi

# Get current version
VERSION=`grep -m1 'version' composer.json | awk -F': ' '{ print $2 }' | sed 's/[",]//g' | tr -d '[[:space:]]'`
IFS='.' read -a version_parts <<< "$VERSION"

# Bump version based on input
case "$1" in
"patch")
    version_parts[2]=$((${version_parts[2]}+1))
    ;;
"minor")
    version_parts[1]=$((${version_parts[1]}+1))
    version_parts[2]=0
    ;;
"major")
    version_parts[0]=$((${version_parts[0]}+1))
    version_parts[1]=0
    version_parts[2]=0
    ;;
esac

NEW_VERSION="${version_parts[0]}.${version_parts[1]}.${version_parts[2]}"

# Change version in the composer.json file
sed -i -r 's/("version": ")([0-9]+\.[0-9]+\.[0-9]+)(",)/\1'"$NEW_VERSION"'\3/' composer.json

echo "Version bumped to $NEW_VERSION"
