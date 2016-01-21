<div id="b2b-info" class="reveal-modal">
    <div style="top: 0px;">
    </div>    
    <a id="close-b2b-info" class="close-reveal-modal"></a>
</div>
<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <div>
    	 <div id="search2" class="f-l">
            <?php echo form_open('b2b/search', array('method'=>'post', 'name'=>'searchname', 'id'=>'searchname'))?>
              <input style="float: left; padding: 7px 5px;" name="keyword" id="keyword" type="text" value="Hvad søger du efter?"/>
              <input class="btnSearch" type="submit" value="Search" name="Search"/>
            </form>
          </div>
    </div>
    <div class="clearfix"></div>
    <table class="b2b">
    	<tr class="b2b-title">
    		<td class="w100">Salgsdato</td>
    		<td>Produktets navn</td>
    		<td class="w130">Antal kuponer solgt</td>
    		<td class="w80"></td>
    	</tr>    
        <?php if($deal){ foreach($deal as $rows){?>
    	<tr>
    		<td><?php echo date("d-m-Y", $rows['time']);?><br/>
            til: <?php echo date("d-m-Y", $rows['end_date']);?></td>
    		<td><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows['id'];?>/<?php echo seo_url($rows['name']);?>.html"><?php echo $rows['name'];?></a></td>
    		<td class="txt-center"><?php echo $rows['quantity']->quantity;?></td>
    		<td class="txt-center"><a href="<?php echo base_url().index_page(); ?>b2b/detail/<?php echo $rows['id'];?>.html">Vis solgte</a></td>
    	</tr>
        <?php }}?>
    </table>
    
    <div style="padding: 10px 0;">
        <p>
        Kommer du i tvivl om noget, er du altid velkommen til at spørge Christina@sugardating.dk eller hos Kundeservice@sugardating.dk
        </p>
    </div>
    
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>
<?php echo modules::run('shop/shop/index'); ?>