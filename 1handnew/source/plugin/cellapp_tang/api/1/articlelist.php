<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forumindex.php 27451 2012-02-01 05:48:47Z monkey $
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}
if ($_GET['tpp']==''){ $_tpp=10;}
   else { $_tpp = $_GET['tpp'];} 
   	
if ($_GET['page']=='') { $_page=1;}
  else {$_page = $_GET['page'];}
  
$start = ($_page -1) * $_tpp;

$sql = 'select a.aid,a.catid,a.bid,a.uid,a.username,a.title,a.highlight,a.author,a.from,a.fromurl,a.url,a.summary,'
       .' a.pic,a.thumb,a.remote,a.id,a.idtype,a.contents,a.allowcomment,a.owncomment,a.click1,a.click2,a.click3,a.click4,'
       .' a.click5,a.click6,a.click7,a.click8,a.tag,a.dateline,a.status,a.showinnernav,a.preaid,a.nextaid,a.htmlmade,a.htmlname,a.htmldir,'
       .' b.viewnum,b.commentnum,b.favtimes,b.sharetimes from '.DB::table('portal_article_title').' as a left outer join '.DB::table('portal_article_count')
       .' as b on a.aid=b.aid where a.catid='.$_GET['catid'] 
       .' order by a.dateline desc limit '.$start.','.$_tpp; 

   
$query = DB::QUERY($sql);
$data = array();
			while($row = DB::fetch($query)) {
				$data[] = cellapp_core::getvalues($row, array(
				'aid', 'catid', 'bid', 'uid', 'username', 'title', 'highlight', 'author', 'from', 'fromurl',
				 'url', 'summary', 'pic', 'thumb', 'remote', 'id', 'idtype', 'contents', 'allowcomment', 
				 'owncomment', 'click1', 'click2', 'click3', 'click4', 'click5', 'click6', 'click7', 
				 'click8', 'tag', 'dateline', 'status', 'showinnernav', 'preaid', 'nextaid', 'htmlmade',
				  'htmlname', 'htmldir','viewnum','commentnum','favtimes','sharetimes'));
		
			}
			

		 $variable = array(
				'data' => $data,
				'page' =>$_page,
				'catid' =>$_GET['catid'],
				'message' => $message		);
    cellapp_core::result(cellapp_core::variable($variable));
    
?>