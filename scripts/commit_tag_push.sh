#!/bin/bash

# Get current version.
VERSION=`grep -m1 'version' composer.json | awk -F': ' '{ print $2 }' | sed 's/[",]//g' | tr -d '[[:space:]]'`

# Commit changes
git add .
git commit -m "Bump version to $VERSION"

# Push the commit
git push origin main

# Add a new tag and push
git tag v${VERSION}
git push origin v${VERSION}

echo "Changes committed, tag 'v$VERSION' created and pushed."
