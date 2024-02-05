<div class="card my-3">
    <div class="card-body">
        <?php
        $userId = $noteUser;
        $userData = getUserData($userId);
        ?>
        <h5 class="fw-bold text-secondary">Author Details</h5>

        <?php if (!empty($userData['name'])) { ?>
            <p class="mb-1 text-capitalize"><b><i class="bi bi-person-fill fs-5 "></i>
                    <?php echo $userData['name']; ?>
                </b></p>
        <?php } ?>

        <?php if (!empty($userData['bio'])) { ?>
            <p class="fst-italic ">Bio :
                <?php echo $userData['bio']; ?>
            </p>
        <?php } ?>

        <?php if (!empty($userData['position']) && !empty($userData['company']) && !empty($userData['companyStart'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-briefcase me-2"></i>
                <?php echo $userData['position']; ?> at
                <?php echo $userData['company']; ?> (
                <?php echo $userData['companyStart']; ?> -
                <?php
                $companyEnd = $userData['companyEnd'];
                if ($companyEnd == 'checked') {
                    echo "Present";
                } else {
                    echo $companyEnd;
                }
                ?>
                )
            </p>
        <?php } ?>

        <!-- educational credentials   -->
        <?php if (!empty($userData['degreeName']) && !empty($userData['graduationYear'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-mortarboard me-2"></i>
                <?php echo $userData['degreeName']; ?> Graduate in
                <?php echo $userData['graduationYear']; ?>
            </p>
        <?php } elseif (!empty($userData['secondarySchool'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-mortarboard me-2"></i>
               Secondary Education from  <?php echo $userData['secondarySchool']; ?> 
            </p>
        <?php } elseif (!empty($userData['primarySchool'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-mortarboard me-2"></i>
              Primary Education from  <?php echo $userData['primarySchool']; ?> 
            </p>
        <?php } ?>

        <?php if (!empty($userData['location'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-geo-alt me-2"></i> Lives in
                <?php echo $userData['location']; ?>
            </p>
        <?php } ?>

        <?php if (!empty($userData['joined'])) { ?>
            <p class="mb-0 text-capitalize"><i class="bi bi-calendar me-2"></i> Joined
                <?php echo date('M Y', strtotime($userData['joined'])) ?>
            </p>
        <?php } ?>
    </div>
</div>
