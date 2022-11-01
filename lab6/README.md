Optimizations:

- The first two optimizations I implemented are seperating and minifying the CSS and JS.
- The third optimization I implemented is turning all the images into a sprite sheet.
- The fourth optimization I made is animating the combs with CSS instead of JS.
- The fifth optimization I made is combining indentical similar CSS rules.
- The sixth optimization I made is making changes to the JS such as using textContent since innerHTML parses HTML.
- The seventh optimization I made is enabling gzip compression. (Note: I do not know if this was active before but I added
it to the root directory)
- The eight optimization I made is adding expire headers


As for what I did beyond this I spent quite a bit of time on the getting everything
that utlized the images to work with the sprite sheet. I made changes to many of the
UI elements and incresed sizes for better readability. I got rid of deprecated html and css.
I added grid, flexbox, changed units, and added a media query to help with cross screen
compatibility. Overall, this lab was very fun.


Works Cited:

Sprite Sheet - https://www.codeandweb.com/free-sprite-sheet-packer

For GZip Compression - https://ubiq.co/tech-blog/enable-gzip-compression-apache/

Expire Headers - https://kinsta.com/knowledgebase/add-expires-headers-wordpress/

Free Bee web client
===================
This is the JavaScript-based web client for Free Bee.

What is Free Bee?
-----------------
Free Bee is an enhanced Free Software clone of The New York Times game
Spelling Bee.

In this game, your goal is to find as many words as you can with the seven
letters you are given. You don't have to use any letter except the middle
letter and letters can be used more than once in a word. Finding a word
that uses all seven letters yields bonus points! Every game has at least
one such word, and many games have multiple.

Earning enough points to reach the rank of Queen Bee wins the game!

You can play the daily challenge like the original game or try your hand at a
nearly infinite number of computer-generated random challenges. Unlike the
original game, you are not restricted to only a single game per day!

The only notable difference between Free Bee and the original game is the use
 of the ENABLE dictionary instead of the NYT dictionary. Patches welcome.

Find us on the web at https://freebee.fun/

License
-------
ISC License. See LICENSE for details.




