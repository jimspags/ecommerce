<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/add-edit-products-style.css"/>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
			$(function() {
				$( "#sortable" ).sortable();
				$( "#sortable" ).disableSelection();
			});
		</script>
    </head>
    <body>
        <div>
            <header>
                <h3>Edit Product - ID 2</h3>
            </header>
        </div>

        <form action="#" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="Hat"/>
    
            <label for="description">Description:</label>
            <textarea name="description"></textarea>
            
            <label for="categories">Categories:</label>
            <details>
                <summary>Hat <span>▼</span></summary>
                <div>
                    <input type="text" value="Shirt"/>
                    <img src="img/pencil.png"/>
                    <img src="img/trash-can.png"/>

                    <input type="text" value="Mug"/>
                    <img src="img/pencil.png"/>
                    <img src="img/trash-can.png"/>
                </div>
            </details>
    
            <label for="new_category">or add new category:</label>
            <input type="text" name="new_category"/>
    
            <p>Images:</p>
            <label for="upload">Upload</label>        
            <input type="file" id="upload" hidden/>
            
            
            <ul id="sortable">
                <li class="ui-state-default">
                    <img src="img/draggable.png"/>
                    <img src="img/magnifying_glass.png"/>
                    <p>img.png</p>
                    <img src="img/trash-can.png"/>
                    <input type="checkbox" name="is_main">
                    <label for="is_main">main</label><br>
                </li>
                <li class="ui-state-default">
                    <img src="img/draggable.png"/>
                    <img src="img/magnifying_glass.png"/>
                    <p>img.png</p>
                    <img src="img/trash-can.png"/>
                    <input type="checkbox" name="is_main">
                    <label for="is_main">main</label><br>
                </li>
                <li class="ui-state-default">
                    <img src="img/draggable.png"/>
                    <img src="img/magnifying_glass.png"/>
                    <p>img.png</p>
                    <img src="img/trash-can.png"/>
                    <input type="checkbox" name="is_main">
                    <label for="is_main">main</label><br>
                </li>
            </ul>
            <input type="reset" value="Cancel" />
            <button action="" type="button">Preview</button>
            <input type="submit" action="" value="Update"/>
        </form>
        
    </body>
</html>