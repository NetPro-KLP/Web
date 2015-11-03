<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                    <a href="/profile"><img alt="image" class="profile-img" src="<? if(empty($result['profileimg'])) echo '/assets/img/default.png'; else echo '/assets/img/' .$result['profileimg'];?>" /></a>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="/profile">
                    <span class="clear">
                    <span class="block m-t-xs">
                    <strong class="font-bold"><?=$result["name"]?></strong>
                    </span>
                    <span class="text-muted text-xs block"><?=$result["position"]?></span> </span> </a>
                </div>
                <div class="logo-element">
                    KLP-Firewall
                </div>
            </li>
            <li>
                <a href="/"><i class="fa fa-th-large"></i> <span class="nav-label">대쉬보드</span></a>
            </li>
            <li>
                <a href="/UC"><i class="fa fa-sitemap"></i> <span class="nav-label">내부 유저 관리</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/UC/Control-Panel">실시간 관제</a></li>
                    <li><a href="/UC/User-Table">유저 테이블</a></li>
                </ul>
            </li>
            <li>
                <a href="/GeoIP"><i class="fa fa-globe"></i> <span class="nav-label">국가별 정보</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/GeoIP/Country-Traffic">국가별 트래픽</a></li>
                    <li><a href="/GeoIP/Traffic-Table">트래픽 테이블</a></li>
                </ul>
            </li>
            <li>
                <a href="/LR/Log-Report">
                <i class="fa fa-database"></i>
                <span class="nav-label">악성 트래픽 리포트</span>
                </a>
            </li>
            <li>
                <a href="/BL/Blacklist">
                <i class="fa fa-lock"></i>
                <span class="nav-label">외부 블랙리스트 관리</span>
                </a>
            </li>
            <li>
                <a href="/PA"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">패킷 분석</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/PA/Traffic-Stats">트래픽 통계</a></li>
                    <li><a href="/PA/Packet-Table">패킷 테이블</a></li>
                </ul>
            </li>
            <li>
                <a href="/RS"><i class="fa fa-edit"></i> <span class="nav-label">룰셋</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/RS/Ruleset-Table">룰셋 테이블</a></li>
                    <li><a href="/RS/Ruleset-Backup-Recovery">룰셋 백업/복원</a></li>
                </ul>
            </li>
            <li>
                <a href="/SC"><i class="fa fa-cog"></i><span class="nav-label">시스템 관리</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/SC/Admin-Account">관리자 계정</a></li>
                    <li><a href="/SC/Notification-Setting">알람 설정</a></li>
                    <li><a href="/SC/ETC-Setting">기타 설정</a></li>
                </ul>
        </ul>
    </div>
</nav>