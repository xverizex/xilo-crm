<?php

$list = $model_ftp->list;
$nlist = $model_ftp->nlist;

echo "<table border='1'>";
echo "<thead><tr><th>mode</th><th>hard link</th><th>file size</th><th>date</th><th>filename</th><th>download</th></tr></thead>";
echo "<tbody>";

	if (strlen ($model_ftp->file) > 1) {
		echo "<tr>";
		echo "<td></td><td></td><td></td><td></td><td><a href='/service/ftp?open=$model_ftp->upper_dir'>..</a></td>";
		echo "</tr>";
	}

	for ($i = 0; $i < sizeof($list); $i++) {
		$filename = strrchr ($nlist[$i], "/");
		$filename = explode ('/', $filename);
		$filename = $filename[1];
		$old_filename = $filename;
		$filename = str_replace ($filename, "<a href='/service/ftp?open=" . $model_ftp->file . '/' . $filename . "'>" . "$filename</a>", $filename);

		$array_lines = array ();

		$line = str_replace ($old_filename, "", $list[$i]);
		$line = explode (' ', $line);
		$index_draw = 0;

		for ($nl = 0; $nl < sizeof ($line); $nl++) {
			if (!empty ($line[$nl])) {
				if ($index_draw == 2 && !is_numeric ($line[$nl])) {
					$array_lines[$index_draw] = 0;
					$index_draw++;
				}
				$array_lines[$index_draw] = $line[$nl];
				$index_draw++;
			}
		}

		$full_buffer_line = "";
		echo "<tr>";
		for ($na = 0; $na < $index_draw; $na++) {
			if ($na == 3) {
				$buf = $array_lines[$na];
				$buf .= " " . $array_lines[$na + 1];
				$buf .= " " . $array_lines[$na + 2];
				echo "<td>$buf</td>";
				$na = 5;
				continue;
			}
			echo "<td>$array_lines[$na]</td>";
		}

		echo "<td>$filename</td>";
		echo "<td><form action='" . "http://localhost:8080/service/ftp'" . " method='POST'>";
	       	echo "<input type='hidden' name='file' value='" . $model_ftp->file . "/" . $old_filename . "'/>";
	       	echo "<input type='hidden' name='filename' value='" . $old_filename . "'/>";
		echo "<input type='submit' value='download'/></form></td></tr>";
	}
	echo "</tbody></table>";
	ftp_close ($model_ftp->ftp);
