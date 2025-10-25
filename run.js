import { parse } from 'dotenv';
import isDocker from 'is-docker';
import { exec } from 'node:child_process';
import { existsSync } from 'node:fs';
import { readFile } from 'node:fs/promises';
import { setTimeout } from 'node:timers/promises';

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

const fn1 = () =>
    exec(
        'pnpm tailwindcss -i ./src/styles/global.css -o ./assets/global.css -w',
    );

const fn2 = async () => {
    while (!existsSync('./assets/global.css')) {
        await setTimeout(125);
    }
    return exec('node esbuild.config.js');
};

Promise.all([fn1(), await fn2()]);
