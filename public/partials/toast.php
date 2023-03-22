<div class="toast-cus p-3">

    <style>
    .toast-cus {
        position: fixed;
        bottom: 16px;
        right: 20px;
    }

    .toast-body {
        font-size: 14px;
        padding: 8px 22px;
    }

    .toast {
        background-color: #fafafa;
        color: #383838;
        font-weight: 500;
    }
    </style>

    <div id="toast-message" class="toast toast-cus align-items-center text-white bg-primary border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <?php
                if (isset($bootstrap['message'])) {
                    echo $bootstrap['message'];
                } else {
                }
                ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>