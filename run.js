import isDocker from 'is-docker';
import { exec } from 'node:child_process';

if (!isDocker()) {
    console.log('You need to run this script from docker!');
    console.log('Use start package.json script!');
    process.exit(1);
}

Promise.all([
    exec(
        'pnpm tailwindcss -i ./src/styles/global.css -o ./assets/global.css -w',
    ),
    exec('node esbuild.config.js'),
]);
