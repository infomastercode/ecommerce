<?php

class Agent{
  
    /* stock type */
    const TYPE_CHECKIN = 'C';
    const TYPE_PUTAWAY = 'S';
    const TYPE_PICKING = 'P';
    const TYPE_PALLET_RELOCATOPN = 'T';
    const TYPE_ADJUSTMENT = 'A';
    const TYPE_REPLENISHMENT = 'R';
    const TYPE_QA_ONHOLD = 'H';
    const TYPE_QA_RELEASE = 'R';
    const TYPE_ITEM_TRANSFER = 'U';
    
    /* status master */
    const STATUS_MASTER_OPEN = 'OPEN';
    const STATUS_MASTER_WAITING = 'WAITING';
    const STATUS_MASTER_PROCESS = 'PROCESS';
    const STATUS_MASTER_BACKORDER = 'BACKORDER';
    const STATUS_MASTER_CLOSE = 'CLOSE';
    const STATUS_MASTER_DELETE = 'DELETE';
    const STATUS_MASTER_CONFIRM = 'CONFIRM';
    const STATUS_MASTER_RECEIPT = 'RECEIPT';
    const STATUS_MASTER_CHECKIN = 'CHECKIN';
    const STATUS_MASTER_PUTAWAY = 'PUTAWAY';
    const STATUS_MASTER_RELEASE = 'RELEASE';
    const STATUS_MASTER_PICKING = 'PICKING';
    const STATUS_MASTER_DISPATCH = 'DISPATCH';
    
    /* status detail */
    const STATUS_DETAIL_OPEN = 'OPEN';
    const STATUS_DETAIL_CLOSE = 'CLOSE';
    const STATUS_DETAIL_CANCEL = 'CANCEL';
    const STATUS_DETAIL_BACKORDER = 'BACKORDER';
    
    /* order type */
    const ORDER_RECEIPT = 'GN';
    const ORDER_ORDERS = 'OD';
    const ORDER_PURCHASE = 'PO';

    /* product config */
    const PROD_CONF_UNIT = 'UNIT';
    
    /* product unit default */
    const UNIT_MAX = 'PALLET';
    const UNIT_MIN = 'PCS';
    
    /* yard */
    const YARD = 'YARD';
    
    /* abount warehouse */
    const ZONE_STATUS_STORAGE = 1;
    const ZONE_STATUS_NONPICKING = 2;
    const ZONE_STATUS_FORCE = 3;
    
    const MSG_STORAGE = 'STORAGE';
    const MSG_NONPICKING = 'NON-PICKING';
    const MSG_FORCE = 'FORCE';
    
    const LOCATION_STATUS_STORAGE = 1;
    const LOCATION_STATUS_FORCE = 2;
    
    /* grade */
    const GRADE_NORMAL = 'N';
    const GRADE_DAMAGE = 'D';
    const GRADE_MSG_NORMAL = 'NORMAL';
    const GRADE_MSG_DAMAGE = 'DAMAGE';
    
    /* process receipt */
    const PROCESS_RECEIPT_SYSTEM = 'S';
    const PROCESS_RECEIPT_MANUAL = 'M';
  
    /* status validate */
    const SUCCESS = 1;
    const ERROR = 0;
    
    /* selector */
    const SELECTOR_ADD = 1;
    const SELECTOR_CANCEL = 2;
    const SELECTOR_SAVE = 3;
    const SELECTOR_SAVE_STAY = 4;
    const SELECTOR_DELETE = 5;
    const SELECTOR_CONFIRM = 6;
    const SELECTOR_PREVIEW = 7;
    const SELECTOR_GENTASK = 8;

    /* abount stock */
    const STOCK_STATUS_AVAIL = 'AVAIL'; // Normal
    const STOCK_STATUS_BLOCK = 'BLOCK'; // Block no put and pick
    const STOCK_DATA_STATUS_NORMAL = 'NORMAL';
    const STOCK_TASK_STATUS_ASSIGN = 'ASSIGN';
    const STOCK_TASK_STATUS_WAITING = 'WAITING';
    const STOCK_TASK_STATUS_PROCESS = 'PROCESS';
    const STOCK_MOVEMENT_STATUS_CLOSE = 'CLOSE';
    
    /* work order */
    const WORK_ORDER_STATUS_ASSIGN = 'ASSIGN';
    const WORK_ORDER_STATUS_PROCESS = 'PROCESS';
    const WORK_ORDER_STATUS_CLOSE = 'CLOSE';
    const WORK_ORDER_STATUS_CANCEL = 'CANCEL';
    
    /* pick method */
    const PICK_METHOD_FEFO_FIFO = 'FEFO_FIFO'; // ASC : Expiry date - Prod date - Lot No - Batch No - Receipt date
    const PICK_METHOD_LEFO_LIFO = 'LEFO_LIFO'; // DESC : Expiry date - Receipt date - Prod date - Lot No - Batch No

    const WAKL_METHOD_MODEL = 'model';
    const WAKL_METHOD_PALLET = 'pallet';
    const WAKL_METHOD_LOCATION = 'location';
}

// end definition