import 'array-iter';
import { context } from 'esbuild';
import { copyFile, mkdir } from 'node:fs/promises';
import { basename } from 'node:path';
import { glob } from 'tinyglobby';

const files = await glob('assets/*.{js,css}', {
    ignore: 'assets/*.min.{js,css}',
});

const other = await glob('assets/*', { ignore: files });

await mkdir('public', { recursive: true });

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

other.iter(async (o) => await copyFile(o, `public/${basename(o)}`));
