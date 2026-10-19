<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- HEADER -->
        <?php include('../includes/header.php'); ?>

		<!-- <style>
            .faq-wrap{position:relative;overflow:hidden;border-radius:24px;padding:56px 40px;
                background:
                    radial-gradient(circle at 0% 60%, rgba(252,205,200,.55), transparent 45%),
                    radial-gradient(circle at 100% 15%, rgba(165,226,248,.65), transparent 45%),
                    radial-gradient(circle at 50% 70%, rgba(205,205,250,.5), transparent 50%),
                    #fff;
                box-shadow:0 10px 40px rgba(100,116,139,.12)}
            .faq-dot{position:absolute;border-radius:50%;pointer-events:none}
            .faq-cat{display:flex;justify-content:space-between;align-items:center;width:100%;
                padding:26px 30px;border-radius:10px;font-size:1.1rem;text-align:left;
                color:#8a8f98;background:rgba(255,255,255,.45);border:1px solid rgba(255,255,255,.7);
                box-shadow:0 2px 8px rgba(100,116,139,.08);transition:.2s}
            .faq-cat:hover{background:rgba(255,255,255,.75)}
            .faq-cat.active{background:#fff;color:#12303a;box-shadow:0 2px 10px rgba(100,116,139,.15)}
            .faq-item{background:rgba(255,255,255,.55);border:1px solid rgba(226,232,240,.8);
                border-radius:10px;margin-bottom:14px;transition:.2s}
            .faq-item.open{background:#fff;box-shadow:0 2px 12px rgba(100,116,139,.12)}
            .faq-q{display:flex;justify-content:space-between;align-items:center;width:100%;
                padding:26px 30px;font-size:1.05rem;color:#12303a;text-align:left}
            .faq-q svg{flex-shrink:0;margin-left:16px;transition:transform .25s}
            .faq-item.open .faq-q svg{transform:rotate(45deg)} /* + becomes X */
            .faq-a{max-height:0;overflow:hidden;transition:max-height .3s ease;
                padding:0 30px;color:#374151;line-height:1.6}
            .faq-item.open .faq-a{padding-bottom:26px}
            .faq-panel{display:none}
            .faq-panel.active{display:block}
        </style> -->
		<style>
			.faq-wrap{position:relative;overflow:hidden;border-radius:24px;padding:56px 40px;
				background:#fff;box-shadow:0 4px 12px rgba(0,0,0,.08)}
			.faq-cat{display:flex;justify-content:space-between;align-items:center;width:100%;
				padding:26px 30px;border-radius:10px;font-size:1.1rem;text-align:left;
				color:#8a8f98;background:#fff;border:1px solid #e5e7eb;transition:.2s}
			.faq-cat:hover{background:#f9fafb}
			.faq-cat.active{color:#12303a;border-color:#d1d5db;box-shadow:0 2px 8px rgba(0,0,0,.1)}
			.faq-item{background:#fff;border:1px solid #e5e7eb;border-radius:10px;margin-bottom:14px;transition:.2s}
			.faq-item.open{border-color:#d1d5db;box-shadow:0 2px 8px rgba(0,0,0,.1)}
			.faq-q{display:flex;justify-content:space-between;align-items:center;width:100%;
				padding:26px 30px;font-size:1.05rem;color:#12303a;text-align:left}
			.faq-q svg{flex-shrink:0;margin-left:16px;transition:transform .25s}
			.faq-item.open .faq-q svg{transform:rotate(45deg)}
			.faq-a{max-height:0;overflow:hidden;transition:max-height .3s ease;
				padding:0 30px;color:#374151;line-height:1.6}
			.faq-item.open .faq-a{padding-bottom:26px}
			.faq-panel{display:none}
			.faq-panel.active{display:block}
		</style>
    </head>
    <body>
        <!-- SIDEBAR -->
        <?php include('../includes/sidebar.php'); ?>	

		<main class="flex-1 p-3 overflow-auto">
            <?php
            // Replace with your own content (or pull from DB)
            $faqs = [
                'General Questions' => [
                    ['How do I time in using Face DTR?', 'Go to your dashboard, click Face DTR, then Time In and capture your face.'],
                    ['What if my face is not recognized?', 'Make sure you have good lighting and your face is fully visible. If it still fails, contact HR.'],
                    ['When is payroll released?', 'Payroll is released every 15th and 30th of the month.'],
                ],
                'Support team' => [
                    ['How do I file a ticket?', 'Open the Ticketing system and click New Ticket.'],
                ],
                'Miscellaneous' => [
                    ['How do I change my password?', 'Go to your profile and choose Change Password.'],
                ],
            ];
            ?>

            <div class="faq-wrap">
                <!-- decorative dots -->
                <span class="faq-dot" style="top:42px;left:51%;width:28px;height:28px;background:#cfd0f7"></span>
                <span class="faq-dot" style="top:140px;left:19%;width:22px;height:22px;background:#a8e4f8"></span>
                <span class="faq-dot" style="top:190px;right:18%;width:40px;height:40px;background:#a8e0f5"></span>
                <span class="faq-dot" style="top:430px;left:4%;width:38px;height:38px;background:#f0b8b0"></span>

                <div class="text-center mx-auto mb-12" style="max-width:720px;position:relative">
                    <h1 style="font-size:3rem;font-weight:700;color:#12303a">Frequently Asked Questions</h1>
                    <p style="margin-top:14px;font-size:1.1rem;color:#12303a">
                        Our platform is built to help you work smarter, not harder. It adapts to your needs and supports your goals.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mx-auto" style="max-width:1200px;position:relative">
                    <!-- Categories -->
                    <div class="md:col-span-2 flex flex-col gap-4">
                        <?php $i = 0; foreach ($faqs as $category => $items): ?>
                            <button type="button" class="faq-cat <?= $i === 0 ? 'active' : '' ?>" data-target="faq-panel-<?= $i ?>">
                                <?= htmlspecialchars($category) ?>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        <?php $i++; endforeach; ?>
                    </div>

                    <!-- Questions -->
                    <div class="md:col-span-3">
                        <?php $i = 0; foreach ($faqs as $category => $items): ?>
                            <div class="faq-panel <?= $i === 0 ? 'active' : '' ?>" id="faq-panel-<?= $i ?>">
                                <?php foreach ($items as $j => $faq): ?>
                                    <!-- <div class="faq-item <?= $j === 0 ? 'open' : '' ?>"> -->
									<div class="faq-item">
                                        <button type="button" class="faq-q">
                                            <?= htmlspecialchars($faq[0]) ?>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                                        </button>
                                        <div class="faq-a"><?= htmlspecialchars($faq[1]) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        </main>

        <script>
            // Category switching
            document.querySelectorAll('.faq-cat').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.faq-cat').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.faq-panel').forEach(p => p.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById(btn.dataset.target).classList.add('active');
                });
            });

            // Accordion (one open at a time per panel)
            function setHeight(item, open) {
                const a = item.querySelector('.faq-a');
                a.style.maxHeight = open ? a.scrollHeight + 'px' : '0px';
            }
            document.querySelectorAll('.faq-item').forEach(item => {
                setHeight(item, item.classList.contains('open'));
                item.querySelector('.faq-q').addEventListener('click', () => {
                    const willOpen = !item.classList.contains('open');
                    item.parentElement.querySelectorAll('.faq-item').forEach(other => {
                        other.classList.remove('open');
                        setHeight(other, false);
                    });
                    if (willOpen) { item.classList.add('open'); setHeight(item, true); }
                });
            });
        </script>

        <script src="../assets/js/user_dashboard.js?v=<?php echo $version; ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    
        <!-- FOOTER -->
        <?php include('../includes/footer.php'); ?>
    </body>
</html>