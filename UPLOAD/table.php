<?php  
function gen_table($files, $categories){
ob_start();?>
 <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>URL</th>
                    <th class="col-2">Category</th>
                    <th class="col-2">Actions</th>
                </tr>
            </thead>
            <tbody>
          <?php foreach ($files as $file) : ?>
                <tr key="">
                    <td><?=$file['filename']?></td>
                    <td><a href="<?=$file['url']?>"><?=$file['filename']?></a></td>
                    <td><?= $file['category_id'] === NULL ? "": $categories[$file['category_id']]?></td>
                    <td></td>
                </tr>
                <?php endforeach ?>
              
            </tbody>
        </table>
    <?php return ob_get_clean();
    }
    ?>