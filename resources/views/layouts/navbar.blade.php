<div class="navbar-custom">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
                <li>
                    <a href="/">
                    <img src="/images/logo.png" width="240">
                    </a>
                </li>

                <li><a href="{{ route('batches.index') }}"><i class="mdi mdi-book-multiple"></i><strong>样品批次</strong></a></li>
                <li><a href="{{ route('projects.index') }}"><i class="mdi mdi-bio"></i><strong>项目任务</strong></a></li>
                <li><a href="{{ route('roadmaps.index') }}"><i class="mdi mdi-arrow-down-bold-hexagon-outline"></i><strong>技术路线</strong></a></li>
                <li><a href="{{ route('procedures.index') }}"><i class="mdi mdi-call-merge"></i><strong>实验流程</strong></a></li>
                <li><a href="{{ route('results.index') }}"><i class="mdi mdi-clipboard-text"></i><strong>结果报告</strong></a></li>
            </ul>

            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->
