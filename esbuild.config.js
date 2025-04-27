import { context } from 'esbuild';
import { existsSync } from 'node:fs';
import { copyFile, mkdir } from 'node:fs/promises';
import { basename } from 'node:path';
import { glob } from 'tinyglobby';

const files = await glob('assets/*.{js,css}', {
    ignore: 'assets/*.min.{js,css}',
});

const other = await glob('assets/*', { ignore: files });

const ctx = await context({
    entryPoints: files,
    outdir: 'public',
    outExtension: {
        '.js': '.min.js',
        '.css': '.min.css',
    },
    minify: true,
    allowOverwrite: true,
});
ctx.watch();

if (!existsSync('public')) {
    await mkdir('public');
}

for (const o of other) {
    await copyFile(o, `public/${basename(o)}`);
}
