import { parse } from 'dotenv';
import isDocker from 'is-docker';
import { exec } from 'node:child_process';
import { existsSync } from 'node:fs';
import { readFile } from 'node:fs/promises';
import { setTimeout } from 'node:timers/promises';

if (!isDocker()) {
    console.log('\x1b[1;31m[ERROR]\x1b[0m You need to run this script from docker!');
    console.log('\x1b[1;34m[INFO]\x1b[0m Use start package.json script!');
    process.exit(1);
}

const env = parse(await readFile('.env'));

if (Object.values(env).some((v) => v.length == 0)) {
    console.log('\x1b[1;31m[ERROR]\x1b[0m Env values cannot be empty!');
    process.exit(1);
}

exec('pnpm tailwindcss -i ./src/styles/global.css -o ./assets/global.css -w');

while (!existsSync('./assets/global.css')) {
    await setTimeout(125);
}

exec('node esbuild.config.js');

console.log('\x1b[1;32m[SUCCESS]\x1b[0m Running...!');
