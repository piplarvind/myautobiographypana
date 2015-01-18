
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/CombinedDashboard.js?v=14"></script>


<script>
    
jQuery(document).ready(function(e) {	
	setInterval( function(e){
	jQuery(".preloader").hide();
	}, 400);
})
</script>
<!----Middle section start----->
<div class="middle-section dr-listing-middle metro">
    <div class="container">
        <div class="page-content entry-content dr-listing-page">
            <h2 class="page-ttl">Digital record listing</h2>
            <div class="loops-wrapper shortcode portfolio portfolio-wrapper grid3 isotope">
                <?php foreach ($arr_digital_records as $digital_records) { ?>
                        <article class="post clearfix portfolio-post  cat-22 orange isotope-item" >
                            <div class="tile-flip-wrapper">
                                <div class="tile-flip">
                                    <div class="front side">
                                        <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details/<?php echo $digital_records["url"] ?>"><img src="<?php echo base_url(); ?>media/front/img/category-images/<?php echo $digital_records['category_image']; ?>" alt="Cherry" width="326">
                                            </a><div class="opacity inner-lbl listing-caption"> <span class="label"><?php echo stripslashes($digital_records['category_name']); ?></span> </div>
                                        </figure>     
                                    </div>
                                    <a href="<?php echo base_url(); ?>digital-record-details/<?php echo $digital_records["url"] ?>"  class="tile-overlay back side">
                                        <div class="post-inner">
                                            <h1 class="post-title"><?php echo stripslashes($digital_records['category_name']); ?></h1>
                                            <p class="dr-desc"><?php if (strlen($digital_records['page_description']) > 300) { ?><?php echo substr((stripslashes(strip_tags($digital_records['page_description']))), 0, 300);
                        } else {
                            echo (stripslashes(strip_tags($digital_records['page_description'])));
                        } ?></p>
                                            <span class="read-more-link"><?php if (strlen($digital_records['page_description']) > 300) {
                            echo "Read more...";
                        } ?></span> </div>
                                    </a> </div>
                            </div>
                        </article>
                <?php   } ?>
                <!--        <article class="post clearfix portfolio-post  cat-22 pink isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/conscience-img.jpg" alt="Out The Bridge" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Conscience</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side" >
                              <div class="post-inner">
                                <h1 class="post-title">My Conscience</h1>
                                <p class="dr-desc">Yes, we all have one, we have a social, a cultural, an environmental, a collective or an individual conscience.
                                  My life spins in an orbit, that comprises of things that I usually live with, this is where my opinions find a dwelling…opinions; again, can be very self-limiting…and then there’s a world beyond my orbit too.</p>
                                <span class="read-more-link">Read more...</span> </div>
                              </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 green isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/confessions-img.jpg" alt="In The Wood" width="326"></a><div class="tile-status bg-dark opacity inner-lbl listing-caption"> <span class="label">My Confessions</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Confessions</h1>
                                <p class="dr-desc">My aim is to live an honorable and good life!
                                  And yet circumstances at times don’t behave predictably and knowingly or unknowingly, I do end up doing stuff that is unpredictable
                                  This is my confession box, where I confess all.</p>
                                <span class="read-more-link">Read more...</span> </div>
                              </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 teal isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/no-img.png" alt="Smoking" width="326"></a>
                                <div class="opacity inner-lbl listing-caption"> <span class="label">My Inhibitions</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Inhibitions</h1>
                                <p class="dr-desc">About “My inhibitions”
                                  These are my “heck, no!! just why couldn’t I say it even as I knew it or do it even as I could go it or wear it even as I loved it” moments
                                  By shedding your inhibitions you become more conscious of yourself. Inhibition; is not necessarily the opposite of exhibition..
                                  </p>
                                <span class="read-more-link">Read more...</span> </div>
                              </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 blue isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/career-img.jpg" alt="Lens Effect" width="326"></a>
                                <div class="opacity inner-lbl listing-caption"> <span class="label">My Career</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Career</h1>
                                <p class="dr-desc">How life develops and how time delivers us where it does, is all a passage and then we pass away. This link here is where I update my career, my achievements, my frustrations, my anxieties, my aspirations, I also update what my colleagues have to say; equally my critiques and all that sums up as the career that I have. </p>
                                <span class="read-more-link">Read more...</span> </div>
                              </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 default newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                               <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/dilemmas-img.jpg" alt="Just a Model" width="326"></a>
                               <div class="opacity inner-lbl listing-caption"> <span class="label">My Dilemmas</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Dilemmas</h1>
                                <p class="dr-desc">An old saying, “all roads are straight and there are no bends in any roads and at each bend stands only another straight road or roads”
                                  It’s true that we are often faced with dilemmas, vicissitudes and value propositions that we have a hard time negotiating.</p>
                                <span class="read-more-link">Read more...</span> </div>
                              </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/regrets-img.jpg" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Regrets</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Regrets</h1>
                                <p class="dr-desc">My aim is to seize the day
                                  My regrets pertain to the opportunities that I have lost, the thank yous that I didn’t say, the sorries that I missed saying, the people I never forgave, the situations that I could have retrieved, the pain I inflicted upon myself or anyone else without thought. <br>
                                 
                                 </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/opportunity-img.jpg" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Opportunities </span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Opportunities </h1>
                                <p class="dr-desc">Nature has a plan in all that happens with our lives, whether it is the places we visit, the journeys we undertake, the books we read or the people we meet. There is a magic involved in everything. The act of discovery does not lie in looking for new lands alone, it involves looking with new eyes too!!<br>
                                  </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/commitments-img.jpg" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Commitments</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Commitments</h1>
                                <p class="dr-desc">About “My commitments”
                The best way to commit is to record your affirmations. Once that is done, it is said the universe conspires to make your dreams come true.
                So this is the place where I commit and set a goal. This could be personal, professional, academic, sport, physical, family, work, chore.
                
                </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/interest-img.jpg" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Interests</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Interests</h1>
                                <p class="dr-desc"> My education is not just my course and curriculum that I have been taught. Life follows a pedagogy that is not set in stone or cast in paper.  Its an adventure by itself
                                  Along with education, it has become vital that the hobbies and interests of the person be mentioned on a resumé. </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 brown newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details" ><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/influencers-img.jpg" alt="Photo Project" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Influencers</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Influencers</h1>
                                <p class="dr-desc">These are the folk, the places, the incidents, the books, the films and the music that have inspired me.. These provide me with the wind beneath my wings
                Do visit the links above and below the film roller on the top and bottom of this page to see more. 
                
                </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details" ><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/journey.jpg" alt="The New Musician" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Journeys </span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Journeys </h1>
                                <p class="dr-desc">I begin with an eloquent piece: http://eu.louisvuitton.com/eng-e1/travel/life-is-a-journey
                
                This life is the biggest gift of all. It is only our own opinions or the narrowness of our vision that can take that fact away.
                </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 default newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/documents-img.jpg" alt="In The Spotlight" width="326"></a>
                                <div class="opacity inner-lbl listing-caption"> <span class="label">My Documents</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Documents</h1>
                                <p class="dr-desc">This is my vault for all the various important documents that I click with my phone camera and transfer here. 
                                  My report cards, my insurance policies, my credit cards, warranties my frequent flyer number or my loyalty card information with retailers, my passwords</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-4 purple newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/flim.jpg" alt="Vintage" width="326"></a>
                                <div class="opacity inner-lbl listing-caption"> <span class="label">My Films</span> </div>
                                
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Films</h1>
                                <p class="dr-desc">My kind of films are a kind of me!!
                                  There is a method to my likes and preferences of films. I grow with them and these grow with me!
                                  Here is how my preferences of films have changed or shall keep changing. This is where I record the name of the films that I have watched or shall watch, its actors, villains, directors</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/wallet-img.jpg" alt="The New Musician" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My wallet</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My wallet </h1>
                                <p class="dr-desc">My finances
                This is where I store all my expenses and incomes in a rather every day and the most simplistic form. Soon team myautobiography will provide me with a simple tool to start budgeting where irrespective of whether I am a student or a housewife or a professional I shall record everything. </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 default newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/friends-img.jpg" alt="In The Spotlight" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Friends</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Friends</h1>
                                <p class="dr-desc">Friends are like the lifeline, this is the place where you treasure them and hold them. 
                                  A friend is someone who gives you total freedom to be yourself and would never judge you even as he voices dissent or agreement or simple inanities. A friend teaches you the true virtue of giving and taking!!</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/music-img.jpg" alt="The New Musician" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Music </span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title"> My Music </h1>
                                <p class="dr-desc">It is the silence between the notes that makes music. The more I can hear the silence, the more I enjoy music. Here is how I journey across the upsies and daisies of my life with my music!!
                                  This is where I shall store one song or singer at a time and later as I shall look back, I will journey with how my music has changed</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 default newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/no-img.png"  alt="In The Spotlight" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My style</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My style</h1>
                                <p class="dr-desc">This is who I was, am and want to be…this is my scrap book of style.
                These are the nuances that define me…my clothes, attire, import, disposition, my etiquette, my ‘in limelight’ moments, my jewelry and adornments, my material acquisitions acquired by virtue of my desire rather than need.
                My fascinations and lure! 
                </p>
                
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-4 purple newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/health-img.jpg" alt="Vintage" width="326"></a>
                                <div class="opacity inner-lbl listing-caption"> <span class="label">My Health and Fitness</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Health and Fitness</h1>
                                <p class="dr-desc">This is where I update my resolutions to remain healthy, inculcate and keep healthy habits. This is also where I record my health parameters and make resolutions to achieve better health. I can keep future resolutions here and look them up each time to see how I am faring.</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/family-img.png" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label"> My Family</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title"> My Family</h1>
                                <p class="dr-desc">Do visit the links above and below the film roller on the top and bottom of this page to see more. If you want to join us or learn more, we encourage you to ask your institution to write to us with your questions or to set up a time for a meeting in person, on phone or over video: </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 lime newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/hobbies-img.png" alt="Another Photo Shot" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My Hobbies</span> </div>
                                </figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My Hobbies</h1>
                                <p class="dr-desc">My education is not just my course and curriculum that I have been taught. Life follows a pedagogy that is not set in stone or cast in paper.  Its an adventure by itself
                Along with education, it has become vital that the hobbies and interests of the person be mentioned on a resumé. 
                
                                  </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 brown newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/project-img.jpg" alt="Photo Project" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">My projects</span> </div></figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">My projects </h1>
                                <p class="dr-desc">i could be a seamstress, a designer, a creator or curator, a surgeon or an engineer, a driver or a photographer, a student or a researcher, a builder or a hacker, an actor or a viewer, a broker or a builder, a runner or a beer guzzler
                          </p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 brown newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/no-img.png" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">Newly added DR</span> </div></figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">Newly added DR </h1>
                                <p class="dr-desc">No data provided</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>
                        <article class="post clearfix portfolio-post  cat-22 brown newItems isotope-item">
                          <div class="tile-flip-wrapper">
                            <div class="tile-flip">
                              <div class="front side">
                                <figure class="post-image"><a href="<?php echo base_url(); ?>digital-record-details"><img src="<?php echo base_url(); ?>media/front/UI-1-media/UI1/img/DR/no-img.png" width="326"></a><div class="opacity inner-lbl listing-caption"> <span class="label">Newly added DR</span> </div></figure>
                              </div>
                              <a href="<?php echo base_url(); ?>digital-record-details" class="tile-overlay back side">
                              <div class="post-inner">
                                <h1 class="post-title">Newly added DR </h1>
                                <p class="dr-desc">No data provided</p>
                              </div>
                              <span class="read-more-link">Read more...</span> </a> </div>
                          </div>
                        </article>-->
            </div>
        </div>
    </div>
</div>
<!----Middle section end-----> 
