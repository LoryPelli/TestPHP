import { parse } from 'dotenv';
import isDocker from 'is-docker';
import { exec } from 'node:child_process';
import { readFile } from 'node:fs/promises';

if (!isDocker()) {
    console.log('You need to run this script from docker!');
    console.log('Use start package.json script!');
    process.exit(1);
}

const env = parse(await readFile('.env'));
if (Object.values(env).some((v) => v.length == 0)) {
    console.log('Env values cannot be empty!');
    process.exit(1);
}

Promise.all([
    exec(
        'pnpm tailwindcss -i ./src/styles/global.css -o ./assets/global.css -w',
    ),
    exec('sleep 2.75 && node esbuild.config.js'),
]);
