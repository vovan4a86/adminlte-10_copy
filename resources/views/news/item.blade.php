@extends('template')
@section('content')
    @include('blocks.bread')
    <div class="blog-area pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details">
                        <div class="blog-img">
                            <img src="{{ $item->image_src }}" alt="{{ $item->name }}">
                        </div>
                        <div class="blog-content">
                            <h1>{{ $item->name }}</h1>
                            <div class="blog-meta">
                                <ul>
                                    <li><a href="#">{{ $item->dateFormat('d m, Y') }}</a></li>
                                </ul>
                            </div>
                            {!! $text !!}
                            <div class="blog-img blog-single-img">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="/img/products/1.jpg" alt="blog-image">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="/img/products/2.jpg" alt="blog-image">
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="/img/products/3.jpg" alt="blog-image">
                                    </div>
                                </div>
                            </div>
                            <div class="blog-share mtb-50">
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 col-sm-6">
                                        <span class="pull-left category-text">Категория: </span>
                                        <ul class="list-inline">
                                            @if ($item->category)
                                                <li><a href="{{ route('news', ['cat' => $item->category->id]) }}"> {{ $item->category->name }}</a></li>
                                            @else
                                                <li><a href="{{ route('news', ['cat' => 0]) }}"> Без категории</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-6">
                                        <div class="social-links text-right">
                                            <ul class="social-link-list">
                                                <li>Share:</li>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fa fa-reddit"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Row -->
                            </div>
                        </div>
                        <div class="blog-pager">
                            <ul class="pager">
                                @if($prev_item)
                                    <li class="previous">
                                        <a href="{{ $prev_item->url }}">
                                            <i class="zmdi zmdi-chevron-left"></i>Предыдущая
                                        </a>
                                    </li>
                                @endif
                                @if($next_item)
                                    <li class="next">
                                        <a href="{{ $next_item->url }}">Следующая
                                            <i class="zmdi zmdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="blog-related-post recent-post mtb-50">
                        <h3 class="sidebar-title">related blog post</h3>
                        <div class="blog-related-post-active owl-carousel">
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/1.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By: </span> <a href="#">Jantrik,</a></li>
                                            <li><span>On: </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/2.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By </span> <a href="#">Jantrik, </a></li>
                                            <li><span>On </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/3.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By </span> <a href="#">Jantrik, </a></li>
                                            <li><span>On </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/1.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By </span> <a href="#">Jantrik, </a></li>
                                            <li><span>On </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/2.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By </span> <a href="#">Jantrik, </a></li>
                                            <li><span>On </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="blog-details.html"><img src="/img/blog/3.jpg" alt="blog-image"></a>
                                </div>
                                <div class="blog-content">
                                    <h4 class="blog-title"><a href="blog-details.html">Lorem ipsum dolor sit amet, consectl adip elit, sed do eiusmod tempor</a></h4>
                                    <div class="blog-meta">
                                        <ul>
                                            <li><span>By </span> <a href="#">Jantrik, </a></li>
                                            <li><span>On </span> <a href="#">05 Nov, 2018</a></li>
                                        </ul>
                                    </div>
                                    <div class="readmore">
                                        <a href="blog-details.html">Read More.....</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                        </div>
                    </div>

                    <div class="comment-area recent-post">
                        <h3 class="sidebar-title">1 COMMENTS</h3>
                        <!-- Single Comment Start -->
                        <div class="single-comment">
                            <div class="comment-img f-left pr-30">
                                <img src="/img/blog/user.jpg" alt="blog-comment">
                            </div>
                            <div class="comment-details fix">
                                <h4><a href="#">RICE JOHNNY</a></h4>
                                <span>August 10, 2018 at 11:08 am</span>
                                <p>But I must explain to you how all this mistaken idea of denouncing pleas praising pain born and I will give you a complete account of the system</p>
                            </div>
                            <a class="reply" href="#">reply</a>
                        </div>
                        <!-- Single Comment End -->
                    </div>

                    <div class="blog-detail-contact">
                        <h3>Leave A Comment</h3>
                        <p class="text-capitalize mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <form id="contact-form" class="contact-form" action="mail.php" method="post">
                            <div class="address-wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="address-fname">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-email">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-web">
                                            <input type="text" name="website" placeholder="Website">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="address-subject">
                                            <input type="text" name="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="address-textarea">
                                            <textarea name="message" placeholder="Type your Comments"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="form-message ml-15"></p>
                            <div class="col-xs-12 footer-content mail-content">
                                <div class="send-email pull-right">
                                    <input type="submit" value="Send" class="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Email Area End -->
                </div>
                <!-- Main Blog End -->
                <!-- Sidebar Main Blog Start -->
                <div class="col-lg-4">
                    <div class="main-right-sidebar border-default universal-padding">
                        @if(count($recent_news))
                            <div class="recent-post pt-30 same-sidebar">
                                <h3 class="sidebar-title">Просмотренные</h3>
                                <ul>
                                    @foreach($recent_news as $item)
                                        <li class="post-thumb fix">
                                            <div class="left-post-thumb f-left mr-20 mb-20">
                                                <a href="{{ $item->url }}">
                                                    <img class="img" src="{{ $item->thumb(1) }}" alt="{{ $item->name }}">
                                                </a>
                                            </div>
                                            <div class="right-post-thumb fix">
                                                <h4><a href="#">{{ $item->name }}</a></h4>
                                                <span>{{ $item->dateFormat('d F, Y') }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="categorie recent-post same-sidebar">
                            <h3 class="sidebar-title mt-40">Категории</h3>
                            <ul class="categorie-list">
                                    <li><a href="{{ route('news', ['cat' => 0]) }}">Без категории</a></li>
                                @foreach($news_categories as $category)
                                    <li><a href="{{ route('news', ['cat' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="categorie recent-post same-sidebar">
                            <h3 class="sidebar-title mt-40">Tags</h3>
                            <ul class="tag-list">
                                <li><a href="#">Tools</a></li>
                                <li><a href="#">Machine</a></li>
                                <li><a href="#">Hardware</a></li>
                                <li><a href="#">Electrical</a></li>
                                <li><a href="#">Drill Machine</a></li>
                                <li><a href="#">Power Saw</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('blocks.brands')
@endsection
