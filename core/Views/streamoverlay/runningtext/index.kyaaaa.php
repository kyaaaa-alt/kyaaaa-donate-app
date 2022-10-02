<div class="marquee">
        <span id="runtext">
            <?php
            foreach($donations as $subarr) {
                if(isset($grouped[((object) $subarr)->customer_name])) {
                    $grouped[((object) $subarr)->customer_name] += ((object) $subarr)->amount;
                    continue;
                }
                $grouped[((object) $subarr)->customer_name] = ((object) $subarr)->amount;
            }
            arsort($grouped);
            foreach ($grouped as $key => $value) {
                echo '<span style="background-color:#fff;color:#000;margin-right:15px;border-radius:10px;padding-left:15px;padding-right:15px;">' . explode(" ", $key)[0] . ': ' . ' Rp ' . number_format($value,0,',','.') . '</span>';
            } ?>
	Scan or go to donate link: https://nauf.space/donate
        </span>
</div>