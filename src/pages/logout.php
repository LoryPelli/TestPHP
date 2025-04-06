<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/logout">
    <span class="text-xl font-bold">Are you sure you want to logout?</span>
    <div class="flex gap-x-1">
        <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Yes!</button>
        <a href="/">
            <button type="button" class="p-1 border-2 rounded-md cursor-pointer">No!</button>            
        </a>
    </div>
</form>
