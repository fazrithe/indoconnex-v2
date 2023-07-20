<?php 
    header('Content-type: application/xml; charset="ISO-8859-1"',true);  
    $datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>

<urlset
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
  xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url(); ?></loc>
        <lastmod><?php echo $datetime1->format(DATE_ATOM); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
	<?php foreach($sitemaps as $sitemap) { 
        $datetime2 = new DateTime($sitemap->last_update);
    ?>
        <url>
            <loc><?php echo base_url($sitemap->slug_url); ?></loc>
            <lastmod><?php echo $datetime2->format(DATE_ATOM); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.5</priority>
        </url>
    <?php } ?>
    <?php foreach ($business_about_sitemaps as $business_about_sitemap) { ?>
    <url>
        <loc><?php echo base_url($business_about_sitemap['slug_business_about_url']); ?></loc>
        <lastmod><?php echo $datetime1->format(DATE_ATOM); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach ($users_sitemaps as $users_sitemap) { ?>
    <url>
        <loc><?php echo base_url($users_sitemap['slug_users_url']); ?></loc>
        <lastmod><?php echo $datetime1->format(DATE_ATOM); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    <?php } ?>
	<?php foreach ($news_sitemaps as $news_sitemap) { ?>
    <url>
        <loc><?php echo base_url($news_sitemap['slug_news_url']); ?></loc>
        <lastmod><?php echo $datetime1->format(DATE_ATOM); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
    </url>
    <?php } ?>
</urlset>
