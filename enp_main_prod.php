<?php
	include("includes/fn_enp_main_prod.php");
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/script_enp_main_prod.js"></script>
	</head>
	<body>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:80%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:100%;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_middle_div" style="border:0px solid; width:80%; float:left;">
				<table width="100%">
					<tr>
						<td width="15%">
							<div align="center"><strong>Production By</strong></div>
						</td>
						<td width="30%">
							<div align="center"><strong>Description</strong></div>
						</td>
						<td width="15%">
							<div align="center"><strong>Frequency</strong></div>
						</td>
						<td width="15%">
							<div align="center"><strong>From</strong></div>
						</td>
						<td width="15%">
							<div align="center"><strong>To</strong></div>
						</td>
						<td width="10%">
							<div align="center"><strong>Submit</strong></div>
						</td>
					</tr>
					<tr>
						<td width="15%">
								<select name="dd_option" style="width:100%"; onChange="srpt_enp_main_prod_dcat_ddl(this.value)">
									<option value="0">
									</option>
<?php
									$menu=fn_enp_main_prod_dcat_ddl();
									$i=0;
									while($i<sizeof($menu))
										{
?>
											<option 
												value="<?php echo $menu[$i]['tb_id']?>">
														<?php echo $menu[$i]['tb_descr']?>
											</option>
<?php
											$i++;
										}
?>
								</select>
						</td>
						<td width="30%">
							<div id="txtHint"></div>
						</td>
						<td width="15%">
							<select id="frequency_ddl" name="frequency_ddl" style="width:100%";>                      
								<option value="0">Weekly</option>
								<option value="1">Monthly</option>
								<option value="2">Quarterly</option>
								<option value="3">Half Yearly</option>
								<option value="4">Yearly</option>
							</select>
						</td>
						<td width="15%">
							<div id="txtHint2"></div>
						</td>
						<td width="15%">
							<div id="txtHint3"></div>
						</td>
						<td width="10%">
							<button onClick="srpt_enp_main_prod_submit_button('t')">Try it</button>
						</td>
					</tr>
				</table>
			</div>
			<div id="enp_main_prod_right_div" style="border:0px solid; width:100%;">
			</div>

			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:80%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:100%;">
			</div>

			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:80%; float:left;">
				<table width="100%" style="border:1px solid;">
					<tr>
						<td width="25%" style="border:1px solid";>
							<div id="enp_monthly_prod_main_div_h2_01" style="border:0px solid; height:30%; float:left;">
								<img src="img/excel.png">
							</div>
							<div id="enp_monthly_prod_main_div_h2_02" style="border:0px solid; height:100%; 
								alignment-adjust:middle;" class="general_lbl">
								<a href="main_page.php?id=enp_field_data_r&id1=D">&nbsp;Download</a>
							</div>
						</td>
						<td width="30%" style="border:1px solid; text-align:right;">
							<button style="width:25%" onClick="srpt_enp_main_prod_submit_button('a')">Aggregate</button>
							<button style="width:25%" onClick="srpt_enp_main_prod_submit_button('pd')">Per Day</button>
						</td>
						<td width="25%" style="border:1px solid; text-align:right;">
							<button style="width:25%" onClick="srpt_enp_main_prod_prd_button('oil')">Oil</button>
							<button style="width:25%" onClick="srpt_enp_main_prod_prd_button('gas')">Gas</button>
							<button style="width:25%" onClick="srpt_enp_main_prod_prd_button('lpg')">LPG</button>
							<button style="width:25%" onClick="srpt_enp_main_prod_prd_button('all')">All</button>
						</td>
					</tr>
				</table>
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:100%;">
			</div>

			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:80%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:100%;">
			</div>

			<div id="enp_main_prod_left_div" style="border:0px solid; width:10%; float:left;">
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:80%; float:left;">
				<div id="txtHint9" style="border:0px solid; overflow:auto;"></div>
			</div>
			<div id="enp_main_prod_left_div" style="border:0px solid; width:100%;">
			</div>
	</body>
</html>
