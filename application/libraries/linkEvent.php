

                        
                        <?php
                        $data['getEvent'] = $this->admin->getEvent();

                         if ($getEvent) :
                            foreach ($getEvent as $ge) :
                        ?>
                        <a class="collapse-item" href="pendaftar">  <?= $ge['NAMA_EVENT']; ?></a>


                    <?php endforeach;
                    else : ?>
                    <a class="collapse-item" href="#">Tidak ada Event</a>
                    <?php endif; ?>

                    
