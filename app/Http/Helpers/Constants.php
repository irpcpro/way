<?php

// regex
const REGEX_MOBILE = "/^09[0-9]{9}$/";
const REGEX_USERNAME = '/^[A-Za-z0-9\.\_]+$/';
const GENERAL_DATE_TIME_FORMAT = 'Y/m/d - H:i:s';

const NAME_LENGTH = 50;
const USERNAME_LENGTH = 20;
const AUTH_CODE_LENGTH = 5;
const AUTH_CODE_EXPIRE_TIME = 90;
const AUTH_CODE_FAKE = true;
const UPLOAD_DIR_NAME = '/uploads';
const AVATAR_DIR_ACCESS = 0755;
const AVATAR_FINAL_EXT = 'jpg';
const AVATAR_FINAL_WIDTH = 800;
const AVATAR_FINAL_HEIGHT = 800;
const AVATAR_FINAL_QUALITY = 80;
const AVATAR_SIZE = 2 * 1024; // MB
const AVATAR_MIN_WiDTH = 450;
const AVATAR_MIN_HEIGHT = 450;
const AVATAR_MIMES = [
    'jpeg',
    'jpg',
    'png'
];
const AVATAR_DIR_NAME = UPLOAD_DIR_NAME . '/avatar';
const USERNAME_ANONYMOUS = 'Anonymous';

const CHAT_MESSAGE_CHARACTER_LIMIT = '500';

const MODELS_CREATED_AT_DEFAULT_FORMAT = 'Y-m-d H:i:s';
const MODELS_UPDATED_AT_DEFAULT_FORMAT = 'Y-m-d H:i:s';
const MODELS_CREATED_AT_FORMAT = 'Y-m-d H:i:s';
const MODELS_UPDATED_AT_FORMAT = 'Y-m-d H:i:s';

const PAGINATE_MESSAGE_LOAD = 20;

const SEND_TO_MEMBERS_MESSAGE_HOOK_PREFIX_CHANNEL_NAME = 'private-';
const SEND_TO_MEMBERS_MESSAGE_HOOK_CHANNEL_NAME = 'new_messages.id_message_hook.';
const USER_CHANNEL_NAME = 'user.';
