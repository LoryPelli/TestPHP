import { context } from 'esbuild';
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
await ctx.watch();

await mkdir('public', { recursive: true });

await Promise.all(
    other.map(async (o) => await copyFile(o, `public/${basename(o)}`)),
);
