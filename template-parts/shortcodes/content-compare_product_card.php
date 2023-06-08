<section class="compare-product-cards">
	<div class="row">
		<div class="columns overflow-x-scroll">
			<table class="table-auto text-center text-[13px] border-collapse border">
				<?php 
				$counter = 1;
				foreach( $comparison as $x => $row_data): 
						if($counter == 1){
							$addclass="tr-heading";
						}
						else{
							$addclass="";
						}

						if($counter % 2 == 0){
							$addclass.=" tr-bg-grey";
						}
						else{
							$addclass.=" tr-bg-white";
						}
					?>
					<tr class="<?php echo $addclass; ?>">
						<?php $cnt = 1; ?>
						<?php foreach($row_data as $value): 
							if($cnt == 1){
								$class="sticky font-g-medium text-base py-5 px-[0.938rem]";
							}
							else{
								$class="";
							}

							if($counter == 2 && $cnt = 1){
								$additional_class = "autoheight";
							}
							else if($counter == 1 && $cnt = 1){
								$additional_class = "first bg-white";
							}
							else{
								$additional_class = "";
							}
						?>
							<td class="<?php echo $class." ".$additional_class; ?> p-[0.938rem] border">
								<?php echo $value ?>
							</td>
							<?php $cnt++; ?>
						<?php endforeach; ?>
					</tr>
				<?php $counter++; endforeach; ?>
			</table>
		</div>
	</div>
</section>