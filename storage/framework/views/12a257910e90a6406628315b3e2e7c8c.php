<?php $__env->startSection('title', 'Kategori '.$kategori->nama); ?>
<?php $__env->startSection('content'); ?>
<div class="container" style="padding-top:40px;">
    <div style="margin-bottom:30px;">
        <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:10px;">
            <a href="<?php echo e(route('beranda')); ?>" style="color:var(--gold)">Beranda</a> › <a href="<?php echo e(route('resep.index')); ?>" style="color:var(--gold)">Resep</a> › <?php echo e($kategori->nama); ?>

        </div>
        <div style="font-size:48px;margin-bottom:10px;"><?php echo e($kategori->icon ?? '🍴'); ?></div>
        <div class="section-title">Resep <span><?php echo e($kategori->nama); ?></span></div>
        <div class="gold-line"></div>
        <?php if($kategori->deskripsi): ?><p style="color:var(--cream-semi);font-size:15px;max-width:600px;"><?php echo e($kategori->deskripsi); ?></p><?php endif; ?>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;">
        <a href="<?php echo e(route('resep.index')); ?>" class="kat-pill">Semua Kategori</a>
        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('kategori.show',$k->slug)); ?>" class="kat-pill <?php echo e($k->id===$kategori->id ? 'active' : ''); ?>"><?php echo e($k->icon ?? ''); ?> <?php echo e($k->nama); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <style>
    .kat-pill{padding:6px 16px;font-size:11px;letter-spacing:2px;text-transform:uppercase;background:transparent;border:1px solid var(--glass-border);color:var(--cream-semi);cursor:pointer;text-decoration:none;transition:all .2s;display:inline-block;}
    .kat-pill:hover,.kat-pill.active{border-color:var(--gold);color:var(--gold);}
    .resep-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;}
    .resep-card{background:var(--dark-lighter);border:1px solid var(--glass-border);overflow:hidden;transition:all .3s;display:block;}
    .resep-card:hover{border-color:var(--gold);transform:translateY(-4px);}
    .card-img{width:100%;height:200px;object-fit:cover;}
    .card-body{padding:16px;}
    </style>

    <?php if($reseps->count()): ?>
    <div class="resep-grid">
        <?php $__currentLoopData = $reseps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('resep.show',$r->slug)); ?>" class="resep-card">
            <?php if($r->gambar): ?><img src="<?php echo e($r->gambar); ?>" alt="<?php echo e($r->judul); ?>" class="card-img">
            <?php else: ?><div class="card-img" style="background:linear-gradient(135deg,#2a1b08,#3a2010);display:flex;align-items:center;justify-content:center;font-size:40px;">🍽️</div><?php endif; ?>
            <div class="card-body">
                <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;"><?php echo e($r->asal_daerah ?? $kategori->nama); ?></div>
                <div style="font-family:'Playfair Display',serif;font-size:17px;margin-bottom:8px;"><?php echo e($r->judul); ?></div>
                <div style="font-size:12px;color:var(--gold);">★ <?php echo e(number_format($r->rating_rata,1)); ?> (<?php echo e($r->ratings->count()); ?>)</div>
                <div style="font-size:12px;color:var(--cream-semi);display:flex;gap:10px;margin-top:8px;">
                    <?php if($r->waktu_memasak): ?><span>⏱ <?php echo e($r->waktu_memasak); ?> mnt</span><?php endif; ?>
                    <span class="badge badge-gold"><?php echo e(ucfirst($r->tingkat_kesulitan)); ?></span>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div style="text-align:center;margin-top:30px;"><?php echo e($reseps->links()); ?></div>
    <?php else: ?>
    <div style="text-align:center;padding:60px;color:var(--cream-semi);">
        <div style="font-size:48px;margin-bottom:12px;">🍽️</div>
        <p>Belum ada resep untuk kategori ini.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RasaNusantara\resources\views/resep/kategori.blade.php ENDPATH**/ ?>