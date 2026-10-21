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
                // $faqs = [
                //     'General Questions' => [
                //         ['How do I time in using Face DTR?', 'Under the My Portal, go to the dashboard, click Face DTR, then Time In/Out and capture your face.'],
                //         ['What if my face is not recognized?', 'Make sure you have good lighting and your face is fully visible. If it still fails, contact HR.'],
                //         ['When is payroll released?', 'Payroll is released every 15th and 30th of the month.'],
                //     ],
                //     'Support team' => [
                //         ['How do I file a ticket?', 'Open the Ticketing system and click New Ticket.'],
                //     ],
                //     'Miscellaneous' => [
                //         ['How do I change my password?', 'Go to your profile and choose Change Password.'],
                //     ],
                // ];
                $faqs = [
                    'General Questions' => [
                        ['How do I time in using Face DTR?', 'Under the My Portal, go to the dashboard, click Face DTR, then Time In/Out and capture your face.'],
                        ['What if my face is not recognized?', 'Make sure you have good lighting and your face is fully visible. If it still fails, contact HR.'],
                        ['When is payroll released?', 'Payroll is released every 15th and 30th of the month.'],
                    ],
                    'Payroll Computation' => [
                        ['How is my salary computed for each cutoff?', <<<'HTML'
                            <p>Your basic salary is computed based on your hourly rate multiplied by the total compensable hours worked during the cutoff.</p>
                            <p><strong>Formula:</strong></p>
                            <p>Hourly Rate = Daily Rate ÷ 8 hours<br>
                            Basic Salary = Hourly Rate × Total Compensable Hours Worked</p>
                            <p><strong>Example:</strong></p>
                            <p>If your daily rate is ₱800 and you have completed 80 compensable working hours for the cutoff:</p>
                            <ul class="list-disc pl-6">
                                <li>Daily Rate: ₱800</li>
                                <li>Hourly Rate: ₱800 ÷ 8 = ₱100</li>
                                <li>Total Hours Worked: 80 hours</li>
                                <li>Computation: ₱100 × 80 hours = <strong>₱8,000</strong></li>
                            </ul>
                            <p>Please note that the final salary may vary depending on applicable deductions, overtime pay, night differential, holiday pay, and other salary adjustments.</p>
                        HTML],
                        ['How is Night Differential (ND) computed?', <<<'HTML'
                            <p>Night Differential is an additional 15% of the employee's hourly rate for eligible hours worked during the applicable night shift period, subject to applicable labor regulations and company policy.</p>
                            <p><strong>Formula:</strong></p>
                            <p>Night Differential = Hourly Rate × 15% × Eligible Night Hours Worked</p>
                            <p><strong>Example:</strong></p>
                            <p>If your hourly rate is ₱100 and you worked 4 eligible night differential hours:</p>
                            <ul class="list-disc pl-6">
                                <li>Hourly Rate: ₱100</li>
                                <li>Night Differential Rate: ₱100 × 15% = ₱15 per hour</li>
                                <li>Eligible Night Hours Worked: 4 hours</li>
                                <li>Computation: ₱15 × 4 hours = <strong>₱60 Night Differential Pay</strong></li>
                            </ul>
                            <p>The night differential amount is added to the employee's applicable salary for the cutoff.</p>
                        HTML],
                        ['What are the payroll cutoff dates?', <<<'HTML'
                            <p>The company follows the following payroll utoff schedule</p>
                            <ul class="list-disc pl-6">
                                <li><strong>First Cutoff:</strong> Every 26th of the previous month to the 10th of the current month.</li>
                                <li><strong>Second Cutoff:</strong> Every 11th to the 25th of the current month.</li>
                            </ul>
                            <p>Employees are encouraged  familiarize themselves with these cutoff dates o understand which attendance records and work hours are covered by each payroll period.</p>
                        HTML], 
                        ['Is payroll processing based on Central Standard Time (CST) or Philippine Time (PHT)?', <<<'HTML'
                            <p>Payroll processing and attendance verification are based on <strong>Philippine Time (PHT)</strong>. Employees working on CST schedules should be aware that their work 
                            schedules and attendance records may fall on different calendar dates when converted to PHT. </p>
                            <p>Employees should refer to the applicable PHT dates when checking their attendance records and payroll coverage. They should also coordinate with their Team Leader or 
                                HR if they need clarification regarding the conversion of their work schedule from CST to PHT.</p>
                        HTML],
                        ['What should I do if I have an attendance or payroll discrepancy?', <<<'HTML'
                            <p>If you notice a discrepancy in your attendance records or salary, you must first submit a formal report detailing the concern. Please include the specific dates involved, 
                                the discrepancy identified, and any supporting documents or records available, such as attendance logs, schedules, payslips, or approved OT forms.</p>
                            <p>The process is as follows:</p>
                            <ol class="list-decimal pl-6">
                                <li><strong>Submit a report:</strong> Report the attendance or payroll discrepancy to HR/Payroll, providing the necessary details and supporting documents.</li>
                                <li><strong>Review and verification:</strong> HR/Payroll will review the submitted report and verify the concern against the available attendance records, 
                                    supporting documents, and other relevant information.</li>
                                <li><strong>Adjustment processing:</strong> If the discrepancy is validated and adjustment is warranted, the necessary correction will be processed in coordination
                                    with the concerned team.</li>
                                <li><strong>Next Payroll cycle:</strong> Any approved adjustment will be reflected in the employee's next applicable payroll cycle.</li>
                            </ol>
                            <p>Please note that the adjustments are subject to verification and approval. Employees are encouraged to submit their concerns promptly and provide complete supporting
                                documents to help facilitate the review.
                            </p>
                        HTML]
                    ],
                    'Account & Profile' => [
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
                                        <div class="faq-a"><?= $faq[1] ?></div>
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