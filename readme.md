# Full Stack Project: Streaming CMS

So what is this thing? We’re building a streaming CMS that’s well, not really a CMS. Hear me out: CMS’s are annoying and you have to deal with permissions and a whole bunch of crap that I really don’t want to deal with. I’m kinda lazy in that regard. I want to build something that is simple to use, easily updates from multiple sources and occasionally updates pages and posts from some other backed up source…like Dropbox. Also, I hate WYSIWYG editors—I want to write in markdown and HTML and I want that to get converted to HTML and it just “magically” shows up on the site. Also, I’d like all of this in real time, or as close to real time as possible.

## Components
+ Laravel 5.5
+ NPM Scripts **not webpack**
+ VueJS
+ Twitter API
+ *Twitch API??*
+ Dropbox API
+ YouTube API

## How does this work?
+ Nearly real time
	+ This is a limitation of API’s
	+ Updates every 5 to 10 minutes
	+ Updates are “held” if you’re scrolling
+ I don’t want to have to “log into” my website
+ Use the tools and things I’m already using to create everything
	+ pages/posts = dropbox
	+ tweets = twitter
	+ videos = youtube

## Build Schedule
### Back end
- [x] Install Laravel
- [x] Minor cleanup, save repo
- [ ] DB Setup
	- [ ] Migrations:
		- [x] Stream
		- [ ] Pages
- [ ] Models/Repositories/Controller
- [ ] Artisan Commands
   - [x] read tweets
	- [x] read youtube
	- [ ] CRUD posts
	- [ ] CRUD images/assets
	- [ ] CRUD pages
- [ ] Transformers
	- [ ] JSON Structure for components
	- [ ] Markdown to HTML
- [ ] “Pinning” items to top of page
- [ ] Checking for updates
- [ ] Updating the stream JSON

### Front End
- [ ] Theme folder structure
- [ ] NPM Scripts Setup
- [ ] Master Page Setup
- [ ] SEO Friendly setup
- [ ] Flexbox and CSS Grid setup
- [ ] Building layouts (responsive)
- [ ] Building components (responsive)
- [ ] Browser Testing (responsive)
- [ ] Integrations: comment system with DISQUS
- [ ] Integrations: AddThis
- [ ] Integrations: GoSquared, Heap Analytics, Google

### “Zero Downtime” Deployment with Forge
- [ ] Forge setup
- [ ] Setting up SSL
- [ ] Domains
- [ ] ENV setup
- [ ] Cron Jobs
- [ ] Production Testing

## Theme Structure
 - `themes`
     - `2017`
         - `assets`
             - `images`
             - `fonts`
             - `sass`
             - `js`
         - `components`
            - `stream`
               - `tweet.blade.php`
               - `pinned.blade.php`
               - `video.blade.php`
               - `live.blade.php`
               - `post.blade.php`
            - `header.blade.php`
            - `navigation.blade.php`
            - `social.blade.php`
            - `comments.blade.php`
         - `pages`
            - `post.blade.php`
            - `stream.blade.php`
            - `page.<type>.blade.php`
         - `master.blade.php`
