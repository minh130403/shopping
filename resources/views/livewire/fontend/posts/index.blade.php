<div>
   <div class="mb-3">
        <div class="container">
            <h2 class="block font-bold text-2xl mb-6">Blog</h2>
            <div class="flex flex-row gap-4">
                <div class="flex-3/4 grid grid-cols-4 gap-2 h-fit">
                    @foreach ($all as $item)
                        <x-my-card :$item type="posts" />
                    @endforeach
                    <div class="col-span-4"> {{ $all->links() }} </div>
                </div>
                 <x-sidebar-cart :root="$categories" title="Danh mục đề xuất" />
            </div>
        </div>
   </div>
</div>
