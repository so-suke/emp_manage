const rp = require('request-promise');
const $ = require('cheerio');
const url = 'https://namegen.jp/?sex=male&country=japan&middlename=&middlename_cond=fukumu&middlename_rarity=&middlename_rarity_cond=ika&lastname=&lastname_cond=fukumu&lastname_rarity=9&lastname_rarity_cond=ika&lastname_type=name&firstname=&firstname_cond=fukumu&firstname_rarity=10&firstname_rarity_cond=ika&firstname_type=name';

rp(url)
  .then(function(html) {
    //success!
    $trs = $('tr', html);
    // $('.name').text();
		const arr = [];
		$trs.each((i, tr) => {
			$tds = $(tr).find('td.name');
			$tds.each((j, td) => {
				arr.push($(td).text().trim());
			});
		});
		console.log(arr)
  })
  .catch(function(err) {
    //handle error
  });
