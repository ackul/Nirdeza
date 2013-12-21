<?php 
$lang_filename = "query/query.php";
include "../templates/normal.inc.php";

//Check if user is authorized
if($userinfo['is_shared_user'] == 1){	unauthorized();}

paintHead();
?>
		<center>
			<br />
			<form name="mysql_query" action="query.php?ID=<?php print $_GET['ID'];?>" method="post">
				<table class=Normal width=550>
					<tr>
						<th><?php print $lang['edit query']; ?></th>
					</tr>
					<tr align="center">
						<td><textarea rows="15" cols="85" name="query"><?php print (isset($_POST['query']))?htmlspecialchars(clearSlashes($_POST['query'])):"";?></textarea></td>
					</tr>
					<tr style="border-width:0px">
						<td align="center">
						<input type=Submit value="<?php print $default_phrases['button send']; ?>">
						&nbsp;
						<input type=reset value="<?php print $default_phrases['button reset']; ?>">
						</td>
					</tr>
				</table>
			</form>&nbsp;
<?php
			if(isset($_POST['query']))
			{
				$query_string = clearSlashes($_POST['query']); 
				$Stats = seperateQuerys($query_string, $client);
				$query = $Stats[3];
		?>
				<br />
				<table class=Normal width="550">
				<tr>
					<th>
						<?php print $lang['query results']; ?>
					</th>
				</tr>
				<tr>
					<td>
						<i><?php print $lang['query']; ?></i> <br />
						<code><?php print syntax($query_string); ?></code><br />
					</td>
				</tr>
				<tr>
					<td>
						<i><?php print $lang['status']; ?></i> <?php print $lang['executed queries']; ?><?php print $Stats[0]; ?> <?php print $lang['errors']; ?><?php print $Stats[1]; ?>
					</td>
				</tr>
				<?php
				if($Stats[1] > 0)
				{
				?>
				<tr>
					<td>
						<?php print $Stats[2]; ?>
					</td>
				</tr>
				<?php
				}
				?>
				</table>
				<?php 
				//Get Results
				$isHead = 0;
				while ($row = $client->fetch_row($query))
				{
					if($isHead == 0)
					{
						?>
						<br />
						<h3><?php print $lang['output']; ?></h3>
						<table class="Normal">
						<tr><?php for ($i = 0; array_key_exists($i, $row) ; $i++){?>
						<th><font size=2>&nbsp;<?php $tmp = $client->fetch_field($query, $i); print $tmp->name;?>&nbsp;</font></th>
						<?php } ?></tr>
						<?php 
						$isHead=1;
					}
					?>
					<tr>
					<?php 
					for ($i = 0; array_key_exists($i, $row) ; $i++)
					{
						?>
						<td><?php print $row[$i];?></font></td>
						<?php
					}
					?>
					</tr>
					<?php 
				}
				if($isHead==1)
				{
					?>
					</table>
					<?php
				}
				else
				{
				?>
					<br />
					<i><?php print $lang['on data available']; ?></i>
				<?php 
				}
			}
			?>
			
		</center>
<?php paintFoot(); ?>
