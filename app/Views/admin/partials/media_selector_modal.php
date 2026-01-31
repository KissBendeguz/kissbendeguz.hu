<!-- Media Selector Modal -->
<div id="media-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-900 border border-white/10 rounded-xl w-full max-w-4xl h-[80vh] flex flex-col shadow-2xl">
        <div class="p-4 border-b border-white/10 flex justify-between items-center bg-slate-800/50 rounded-t-xl">
            <h3 class="text-lg font-bold text-white">Média kiválasztása</h3>
            <button type="button" onclick="closeMediaModal()" class="text-slate-400 hover:text-white">&times;</button>
        </div>
        
        <div class="flex-1 overflow-y-auto p-4" id="media-grid">
            <!-- Loading -->
            <div class="text-center text-slate-500 py-10">Betöltés...</div>
        </div>

        <div class="p-4 border-t border-white/10 bg-slate-800/50 rounded-b-xl flex justify-between items-center">
             <form id="modal-upload-form" class="flex gap-2">
                <input type="hidden" name="api" value="1">
                <?= csrf_field() ?>
                <input type="file" name="file" required class="text-sm text-slate-400 file:mr-2 file:py-1 file:px-3 file:rounded-full file:bg-cyan-600 file:text-white file:border-0 hover:file:bg-cyan-500">
                <button type="submit" class="px-3 py-1 bg-emerald-600 text-white rounded text-sm hover:bg-emerald-500">Feltöltés</button>
            </form>
            <button type="button" onclick="closeMediaModal()" class="px-4 py-2 bg-slate-700 text-white rounded hover:bg-slate-600">Mégse</button>
        </div>
    </div>
</div>

<script>
let targetInputId = null;
let targetPreviewId = null;

function openMediaModal(inputId, previewId = null) {
    targetInputId = inputId;
    targetPreviewId = previewId;
    document.getElementById('media-modal').classList.remove('hidden');
    loadMedia();
}

function closeMediaModal() {
    document.getElementById('media-modal').classList.add('hidden');
    targetInputId = null;
    targetPreviewId = null;
}

function loadMedia() {
    fetch('/admin/media?api=1')
        .then(res => res.json())
        .then(data => {
            const grid = document.getElementById('media-grid');
            if (data.length === 0) {
                grid.innerHTML = '<div class="text-center text-slate-500 py-10">Nincs még feltöltött média.</div>';
                return;
            }
            grid.innerHTML = '<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">' + 
                data.map(item => `
                    <div onclick="selectMedia('${item.filepath}')" class="cursor-pointer group relative aspect-square bg-slate-800 border border-white/10 rounded overflow-hidden hover:border-cyan-500 transition">
                        <img src="/${item.filepath}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-cyan-500/20 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                `).join('') + 
                '</div>';
        });
}

function selectMedia(path) {
    if (targetInputId) {
        document.getElementById(targetInputId).value = path;
    }
    if (targetPreviewId) {
        document.getElementById(targetPreviewId).src = '/' + path;
        document.getElementById(targetPreviewId).classList.remove('hidden');
    }
    closeMediaModal();
}

document.getElementById('modal-upload-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/admin/media/upload', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            this.reset();
            loadMedia();
        } else {
            alert('Hiba: ' + data.error);
        }
    })
    .catch(err => alert('Feltöltési hiba'));
});
</script>
