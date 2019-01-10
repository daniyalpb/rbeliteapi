<!-- sidebar nav starts -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/dashboard')); ?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/product-list')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Product List</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/order-list')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Lead Allocation</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/crm')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">CRM</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/category-list')); ?>">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Category List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/company-master')); ?>">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Company Master</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/document-master')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Document Master</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/documents-mapping')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Productwise Document Mapping</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/Document-Requests')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Document Verification</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/agent-list')); ?>">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Agent Master</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/elite-card-master')); ?>">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Elite Card Master</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('/rto-list')); ?>">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">RTO Master</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(url('/Payment-Report')); ?>">Payment Report</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(url('/Basic-Report')); ?>">Basic Report</a>
                </li>
              </ul>
            </div>
          </li>
          
        </ul>
      </nav>
<!-- sidebar nav ends -->