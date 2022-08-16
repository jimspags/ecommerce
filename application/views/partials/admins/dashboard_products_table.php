<?php
    foreach($products as $product) {
?>
                <tr>
                    <td><img src="<?= base_url() ?>assets/img/magnifying_glass.png"></td>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['stock_count'] ?></td>
                    <td><?= $product['quantity_sold'] ?></td>
                    <td> 
                        <button id="edit" value="<?= $product['id'] ?>">edit</button>
                        <button id="delete" title="<?= $product['product_name'] ?>" action="<?= base_url() ?>dashboard/delete_product/<?= $product['id'] ?>">delete</button>
                    </td>
                </tr>
<?php
    }
?>
<form action="#" method="POST">

                <label for="name">Name:</label>
                <input type="text" name="name" value="Magnifying Glass"/>
        
                <label for="description">Description:</label>
                <textarea name="description">Small size</textarea>
                
                <label for="categories">Categories:</label>
                <details>
                    <summary>Tools<span>▼</span></summary>
                    <div>
                        <section>
                            <input class="category" type="text" value="Hardware" name="category" readonly/>
                            <img class="edit" src="<?= base_url() ?>assets/img/pencil.png"/>
                            <img class="remove" title="Hardware" src="<?= base_url() ?>assets/img/trash-can.png"/>
                        </section>

                    </div>
                </details>
        
                <label for="new_category">or add new category:</label>
                <input type="text" name="new_category"/>
                <input type="hidden" name="category">
                <p>Images:</p>
                <label for="upload">Upload</label>        
                <input type="file" id="upload" hidden/>
                
                
                <ul id="sortable">
                    <li class="ui-state-default">
                        <img src="<?= base_url() ?>assets/img/draggable.png"/>
                        <img src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                        <p>img1.png</p>
                        <img class="remove" title="img1.png" src="<?= base_url() ?>assets/img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                    <li class="ui-state-default">
                        <img src="<?= base_url() ?>assets/img/draggable.png"/>
                        <img src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                        <p>img2.png</p>
                        <img class="remove" title="img2.png" src="<?= base_url() ?>assets/img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                    <li class="ui-state-default">
                        <img src="<?= base_url() ?>assets/img/draggable.png"/>
                        <img src="<?= base_url() ?>assets/img/magnifying_glass.png"/>
                        <p>img3.png</p>
                        <img class="remove" title="img3.png" src="<?= base_url() ?>assets/img/trash-can.png"/>
                        <input type="checkbox" name="is_main">
                        <label for="is_main">main</label><br>
                    </li>
                </ul>
                <button type="button" id="cancel">Cancel</button>
                <button type="button" id="preview">Preview</button>
                <input type="submit" value="Update"/>
            </form>
<script>
    $(document).ready(function() {
        //form modal
        $("button#edit").on("click", function() {
            console.log($(this).attr("value"))
            $.get("<?= base_url() ?>dashboard/get_product" + $(this).attr("value"), function(data){
                $("input[name='name']").val(data.product_name);
                $("textarea[name='description']").val(data.description);
                $("summary").html(data.category_name + "<span>▼</span>");
                $("input[name='category']").val(data.category_name);
                $("#form-edit-dialog").dialog("open");
            }, "json");
            
        });

        $("#form-edit-dialog").dialog({
            autoOpen: false,
            title: "Edit Product - ID 2"
        });

        //edit category
        $(document).on('click', "img.edit", function() {
            $(this).siblings("input").removeAttr("readonly");
        });
    })

</script>