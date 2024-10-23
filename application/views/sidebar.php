<!-- Sidebar -->
<aside id="sidebar" class="bg-darker-purple flex-shrink-0 flex flex-col sidebar-transition sidebar-expanded">
    <div class="p-4 flex items-center justify-between">
        <h1 id="brand" class="text-xl font-bold text-white">Form Builder.</h1>
        <button id="toggleBtn" class="text-light-purple hover:text-white">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>
    <div id="searchContainer" class="px-4 mb-4">
        <input type="text" placeholder="Search" class="w-full bg-dark-purple text-light-purple px-3 py-2 rounded">
    </div>
    <nav class="mt-4 flex flex-col">
        <a href="<?= base_url('form/segment'); ?>" class="sidebar-link flex items-center py-2 px-4">
            <i class="fas fa-layer-group w-5 text-center"></i> <span class="ml-3 sidebar-text">Segment</span>
        </a>
        <a href="<?= base_url('form/name'); ?>" class="sidebar-link flex items-center py-2 px-4">
            <i class="fas fa-font w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Name</span>
        </a>
        <a href="<?= base_url('form/structure'); ?>" class="sidebar-link flex items-center py-2 px-4">
            <i class="fas fa-sitemap w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Structure</span>
        </a>
        <a href="<?= base_url('form/generate'); ?>" class="sidebar-link flex items-center py-2 px-4">
            <i class="fas fa-magic w-5 text-center"></i> <span class="ml-3 sidebar-text">Form Generate</span>
        </a>
        <a href="<?= base_url('login/logout'); ?>" class="sidebar-link flex items-center py-2 px-4 mt-4 rounded">
            <i class="fas fa-sign-out-alt w-5 text-center"></i> <span class="ml-3 sidebar-text">Logout</span>
        </a>
    </nav>
</aside>