import isDocker from 'is-docker';
import { execSync } from 'node:child_process';

if (!isDocker()) {
    console.log('You need to run this script from docker!');
    process.exit(1);
}

Promise.all([
    new Promise(() =>
        execSync(
            'pnpm tailwindcss -i ./src/styles/global.css -o ./assets/global.css -w',
        ),
    ),
    new Promise(() => execSync('sleep 2.75 && node esbuild.config.js')),
]);
