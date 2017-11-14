<style type="text/css">
	.no-bdr {
	  border-collapse: collapse;
	  border-spacing: 0;
	}
	table {table-layout:fixed;}
	.tbl {border:2px solid #000; width:90%; }
	.bdr {border:2px solid #000;}
	.heading {font-size:19px; font-weight:bold; text-align:center; margin-bottom:5px;}
	.pt-2 {padding-top:2px;}
	.pb-2 {padding-bottom:2px;}
	.p-2 {padding:2px;}
	.td-bdr {border:1px solid #000;}
	.theading {background:#000; color:#fff; text-transform:uppercase; padding:5px; }
	
</style>

<page backtop="10mm" backbottom="10mm" backleft="5mm" backright="5mm" style="font-size:8pt;">
	<div class="wraper">
		<div class="heading">APPLICATION FOR MERCHANT CARD PROCESSING</div>
		<table class="tbl tbl1">
			<tr>
				<td style="width:33%">
					STW Short Name: <input type="text" name="n1" id="i1"/>
				</td>
				<td style="width:33%">
					Assoc #: <input type="text" name="n3" id="i3"/>
				</td>
				<td style="width:33%">
				
				</td>
			</tr>
			<tr>
				<td style="width:33%">
					Sales Rep Name: <input type="text" name="n2" id="i2"/>
				</td>
				<td style="width:33%">
					Sales Rep Code: <input type="text" name="n4" id="i4"/>
				</td>
				<td style="width:33%">
					Branch #: (if applicable) <input type="text" name="n5" id="i5"/>
				</td>
			</tr>
		</table>
		<div class="pt-2 pb-2">For purposes of this application, "Processor" or "TSYS" is TSYS Business Solutions, LLC, or one of its affiliates, located at 12202 Airport Way, Suite 100 Broomfield, CO 80021 and can be contacted at (800) 654-9256. Additional information can be found on the TSYS-affiliated website, www.TransFirst.com.</div>
		
		<div class="theading">1. BUSINESS INFORMATION</div>
		<table class="tbl tbl2">
			<tr>
				<td class="td-bdr">
					<table class="no-bdr" style="width: 90pt">
						<tr>
							<td colspan="3" class="td-bdr p-2">
								<div>Legal Name of Business (25 characters max)</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="td-bdr p-2">
								<div>Legal Address</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td class="td-bdr p-2">
								<div>Suite</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td class="td-bdr p-2">
								<div>City</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td class="td-bdr p-2">
								<div>State</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
							<td class="td-bdr p-2">
								<div>ZIP</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td class="td-bdr p-2">
								<div>Legal Phone Number</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td colspan="2" class="td-bdr p-2">
								<div>Legal Fax Number</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
					</table>
					
					
				</td>
				<td class="td-bdr">
					<table style="width: 90pt" class="no-bdr">
						<tr>
							<td colspan="3" class="td-bdr p-2">
								<div>Legal Name of Business (25 characters max)</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="td-bdr p-2">
								<div>Legal Address</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td class="td-bdr p-2">
								<div>Suite</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td class="td-bdr p-2">
								<div>City</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td class="td-bdr p-2">
								<div>State</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
							<td class="td-bdr p-2">
								<div>ZIP</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
						<tr>
							<td class="td-bdr p-2">
								<div>Legal Phone Number</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
								
							</td>
							<td colspan="2" class="td-bdr p-2">
								<div>Legal Fax Number</div>
								<input type="text" style="width:100%" value="<?php echo $row['q80']; ?>" name="n6" id="i6" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="td-bdr p-2">
					Email Address for Notices: <input type="text" style="width:500px" name="n20" id="i20"/>
					<p>(See "Notices" in the Merchant Card Processing Agreement included with this application for additional information relating to email address usage.)</p>
				</td>
			</tr>
		</table>
	
	</div>
</page>