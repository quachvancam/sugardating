<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<div class="ad-content">
  	<div class="btn-admin f-r">
        <a href="<?php echo base_url().index_page(); ?>article/add.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-add-ad.jpg" alt=""/></a>
        <a href="javascript:deleteButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-del.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="searchForm" action="<?php echo base_url().index_page(); ?>article/search.html" method="get" class="ad-search">
        <fieldset>
          <div class="f-l">
            <label>Filter</label>
            <input type="text" name="keyword" value="<?php echo $this->input->get('keyword')?$this->input->get('keyword'):'';?>" class="txt-find">
          </div>
          <input type="submit" value="Search" class="editUser f-l" />
        </fieldset>
    </form>
    <form method="post" id="articleForm" action="<?php echo base_url().index_page(); ?>article/delete.html">
    <table class="table-admin">
        <tr class="titleSearch">
            <td width="5%"><input type="checkbox" class="checkall" style="width:10px !important" /></td>
            <td width="5%">ID</td>
            <td width="20%">Title</td>
            <td width="30%">Short content</td>
            <td width="10%">Category</td>
            <td width="10%">Created</td>
            <td width="5%">Publish</td>
            <td width="5%">Sort <a href="javascript:sortButton('articleForm', '<?php echo base_url().index_page(); ?>common/sort_order.html');"><img src="<?php echo base_url(); ?>assets/backend/img/sort_save.png" alt=""/></a></td>
            <td width="10%">Article link</td>
        </tr>
        <?php foreach($articles as $article){
			$link = base_url().index_page()."article/edit/".$article->id.".html";
            $frontend_link = base_url().'index.php/articles/view/'.$article->id.'/'.$article->alias.'.html';	
		?>
        <tr>
            <td><input type="checkbox" value="<?php echo $article->id;?>" class="checkadmin" name="id[]" style="width:10px !important" /></td>
            <td><?php echo $article->id;?></td>
            <td><a href="<?php echo $link;?>"><?php echo $article->title;?></a></td>
            <td><?php echo $article->short_content;?></td>
            <td><?php echo $article->category_name;?></td>
            <td><?php echo myfull_date($article->time);?></td>
            <td><img src="<?php echo base_url(); ?>assets/backend/img/<?php echo $article->publish?'iconcheck1.png':'iconClose2.png';?>" onclick="publish('article', <?php echo $article->id;?>, <?php echo $article->publish? 0 : 1;?>)" style="cursor:pointer;" /></td>
            <td><input type="text" name="ordering[<?php echo $article->id;?>]" value="<?php echo $article->ordering?>" style="text-align:center; width:20px;"></td>
            <td><?php echo $frontend_link;?></td>
        </tr>
        <?php }?>
   	</table>
    <input type="submit" style="display:none" id="submitButton" />
    <input type="hidden" name="return_url" value="article" />
    <input type="hidden" name="table" value="article" />
    </form>
    <div class="pagging2 clear">
        <div class="f-l m-l130">
        <form action="<?php echo base_url().index_page(); ?>common/change_num.html" method="post">
          <label>view per page</label>
          <input type="text" value="<?php echo get_item_per_page();?>" class="txt" name="item_per_page" maxlength="2">
          <input type="submit" class="bntSelect f-r" value="Vælg" />
          <input type="hidden" name="return" value="/article" />
        </form>
        </div>
        <?php echo $all_link;?>
    </div>
</div>