<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\BootstrapAsset;
use app\assets\AppAsset;
use app\models\User;
/* @var $this \yii\web\View */
/* @var $content string */
app\modules\admin\AdminAsset::register($this);
?>    
    <div class="si-inner">
        <div class="profile-menu">
            <a href="#">
                <div class="profile-pic">
                    <img src="/web/backend/img/profile-pics/1.jpg" alt="">
                </div>
                
                <div class="profile-info">
                    Malinda Hollaway
                    
                    <i class="md md-arrow-drop-down"></i>
                </div>
            </a>
            
            <ul class="main-menu">
                <li>
                    <a href="#"><i class="md md-person"></i> View Profile</a>
                </li>
                <li>
                    <a href="#"><i class="md md-settings-input-antenna"></i> Privacy Settings</a>
                </li>
                <li>
                    <a href="#"><i class="md md-settings"></i> Settings</a>
                </li>
                <li>
                    <a href="/admin/auth/logout"><i class="md md-history"></i> Logout</a>
                </li>
            </ul>
        </div>
        
        <ul class="main-menu sidebar-nav">
            <?php $current_controller = \Yii::$app->controller->id;?>
            <li class="<?= ($current_controller == 'dashboard') ? 'active' : '' ?>">
                <a href="/admin/dashboard/index"><i class="md md-home"></i> Dashboarch</a>
            </li>
            <li class="sub-menu
                    <?php 
                    if ($current_controller == 'assignment' 
                        || $current_controller == 'permission' 
                        || $current_controller == 'route' 
                        || $current_controller == 'role' 
                        || $current_controller == 'rule') echo 'active toggled'; ?>">
                <a href="#" data-target="#userMenu" data-toggle="collapse">
                    <i class="md md-view-list"></i> 
                    <span class="sidebar-nav-mini-hide">Authorization</span>
                </a>
                <ul class="
                    <?php 
                    if ($current_controller == 'assignment' 
                        || $current_controller == 'permission' 
                        || $current_controller == 'route' 
                        || $current_controller == 'role' 
                        || $current_controller == 'rule') echo 'in'; ?>" id="userMenu">

                    <li class="<?php if ($current_controller == 'assignment') echo 'active'; ?>">
                        <a href="/admin/assignment">
                            <i class="icon-home"></i>Assignments
                        </a>
                    </li>
                    <li class="<?php if ($current_controller == 'role') echo 'active'; ?>">
                        <a href="/admin/role">
                            <i class="icon-envelope-alt"></i>Roles 
                        </a>
                    </li>
                    <li class="<?php if ($current_controller == 'permission') echo 'active'; ?>">
                        <a href="/admin/permission"><i class="icon-cogs"></i>Permissions</a>
                    </li>
                    <li class="<?php if ($current_controller == 'route') echo 'active'; ?>">
                        <a href="/admin/route"><i class="icon-comment"></i>Routes</a>
                    </li>
                    <li class="<?php if ($current_controller == 'rule') echo 'active'; ?>">
                        <a href="/admin/rule"><i class="icon-user"></i>Rule</a>
                    </li>
                </ul>
            </li>
            <li class="<?= ($current_controller == 'users') ? 'active' : '' ?>"><a href="/admin/users"><i class="md md-person"></i> User</a></li>
        </ul>
    </div>