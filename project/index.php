<?php
include_once('connection.php');
// pull a cursor query
$cursor = $collection->find();
// Config
$dbhost = '192.168.16.53';
$dbname = 'mobilegames';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");

$db = $m->$dbname;
// select the collection
$collection = $db->mobilegamesCollection;
?>

<div class="clearfix well">
	<a href="add.php" class="btn btn-primary pull-right">Add New</a>
</div>
<div class="col-xs-6">
	<table id="simple-table" class="table table-striped table-bordered table-hover">
	  <thead>
		<tr>
		  <th>URL</th>
		  <th>ID</th>
		  <th>Name</th>
		  <th>Subtitle</th>
		  <th>Icon URL</th>
		  <th>Average User Rating</th>
		  <th>User Rating Count</th>
		  <th>Price</th>
		  <th>In-app Purchases</th>
		  <th>Description</th>
		  <th>Developer</th>
		  <th>Age Rating</th>
		  <th>Languages</th>
		  <th>Size</th>
		  <th>Primary Genre</th>
		  <th>Genres</th>
		  <th>Original Release Date</th>
		  <th>Current Version Release Date</th>
		</tr>

	  </thead>
	  <tbody>
		<?php 
		foreach ($cursor as $document) {?>
		<tr>
		  <td><?php echo $document['URL']?></td>
		  <td><?php echo $document['ID']?></td>
		  <td><?php echo $document['Name']?></td>
		  <td><?php echo $document['Subtitle']?></td>
		  <td><?php echo $document['Icon URL']?></td>
		  <td><?php echo $document['Average User Rating']?></td>
		  <td><?php echo $document['User Rating Count']?></td>
		  <td><?php echo $document['In-app Purchases']?></td>
		  <td><?php echo $document['Description']?></td>
		  <td><?php echo $document['Developer']?></td>
		  <td><?php echo $document['Age Rating']?></td>
		  <td><?php echo $document['Languages']?></td>
		  <td><?php echo $document['Size']?></td>
		  <td><?php echo $document['Primary Genre']?></td>
		  <td><?php echo $document['Genres']?></td>
		  <td><?php echo $document['Original Release Date']?></td>
		  <td><?php echo $document['Current Version Release Date']?></td>
		  <td>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="edit.php?id=<?php echo $document['_id']?>">Edit</a>
				
				<form action="index.php?_id=<?php echo $document['_id']; ?>" method="post" class="inline">
					<input name="_method" type="hidden" value="DELETE">
				  <button class="btn btn-danger" id="delete-rec" name="delete-rec" type="submit">Delete</button>
				</form>
			</td>
		</tr>
		<?php }
		?>
	  </tbody>
	  </table>
	</table> 
 </div>