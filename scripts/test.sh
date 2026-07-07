#!/usr/bin/env bash
#
# Run the full PHP test matrix (7.4 -> 8.5) in isolated containers.
# Each container installs its own composer dependencies, runs the PHPUnit
# suite, then runs PHPStan. Exits non-zero if any version fails.
#
set -uo pipefail

VERSIONS=(php74 php80 php81 php82 php83 php84 php85)
failed=()

echo "Running test matrix: ${VERSIONS[*]}"
echo

for v in "${VERSIONS[@]}"; do
    echo "==================================================================="
    echo "=== $v"
    echo "==================================================================="
    if docker compose run --rm "$v"; then
        echo ">>> PASS: $v"
    else
        echo ">>> FAIL: $v"
        failed+=("$v")
    fi
    echo
done

echo "==================================================================="
if [ ${#failed[@]} -eq 0 ]; then
    echo "ALL VERSIONS PASSED: ${VERSIONS[*]}"
    exit 0
fi

echo "FAILED (${#failed[@]}): ${failed[*]}"
exit 1
