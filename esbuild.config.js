import { context } from 'esbuild';
import { copyFile, mkdir } from 'node:fs/promises';
import { basename } from 'node:path';
import { glob } from 'tinyglobby';
import 'array-iter';

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

other.iter(async (o) => await copyFile(o, `public/${basename(o)}`));
