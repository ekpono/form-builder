import SettingSwitch from '@/Components/FormBuilder/SettingSwitch'
import SettingCheckboxes from '@/Components/FormBuilder/SettingCheckboxes'
import SettingInput from '@/Components/FormBuilder/SettingInput'
import SettingInputNumber from '@/Components/FormBuilder/SettingInputNumber'

export const QUESTION_CATEGORY_KICK_OFF = 'kick_off'
export const QUESTION_CATEGORY_FOLLOW_UP = 'follow_up'
export const QUESTION_CATEGORY_TYP = 'typ'

export const QUESTION_CATEGORY_NAME = {
  [QUESTION_CATEGORY_KICK_OFF]: 'Kick-off Question',
  [QUESTION_CATEGORY_FOLLOW_UP]: 'Follow-up Question',
  [QUESTION_CATEGORY_TYP]: 'Thank You Page'
}

export const QUESTION_TYPE_OPEN = 'open'
export const QUESTION_TYPE_MULTIPLE_CHOICE = 'multiple_choice'
export const QUESTION_TYPE_YES_NO = 'yes_no'
export const QUESTION_TYPE_DELAY = 'delay'
export const QUESTION_TYPE_RATING_SCORE = 'rating_score'
export const QUESTION_TYPE_PURCHASED_ITEMS_CHOICE = 'purchased_items_choice'
export const QUESTION_TYPE_UPLOAD_FILES = 'upload_files'

export const QUESTION_TYPE_NAME = {
  [QUESTION_TYPE_OPEN]: 'Open',
  [QUESTION_TYPE_MULTIPLE_CHOICE]: 'Multiple choice',
  [QUESTION_TYPE_YES_NO]: 'Yes/No',
  [QUESTION_TYPE_DELAY]: 'Delay',
  [QUESTION_TYPE_RATING_SCORE]: 'Rating score'
}

export const PURCHASED_ITEMS_CHOICE_QUESTION = {
  id: QUESTION_TYPE_PURCHASED_ITEMS_CHOICE,
  type: QUESTION_TYPE_PURCHASED_ITEMS_CHOICE,
  title: 'Which of your purchases would you like to review?'
}

export const uploadFilesQuestion = (itemId) => ({
  id: QUESTION_TYPE_UPLOAD_FILES + itemId,
  type: QUESTION_TYPE_UPLOAD_FILES,
  title: 'Do you have any photos or videos to add to your review?',
  order_item_id: itemId
})

export const COMMON_SETTINGS = {
  required: { c: SettingSwitch }
}

export const SETTINGS = {
  [QUESTION_TYPE_OPEN]: COMMON_SETTINGS,
  [QUESTION_TYPE_MULTIPLE_CHOICE]: {
    ...COMMON_SETTINGS,
    allow_multiple_selection: { c: SettingSwitch },
    randomize: { c: SettingSwitch },
    allow_other_choice: { c: SettingSwitch }
  },
  [QUESTION_TYPE_YES_NO]: COMMON_SETTINGS,
  [QUESTION_TYPE_DELAY]: {
    ...COMMON_SETTINGS,
    period: { c: SettingCheckboxes, s: { options: ['days', 'weeks', 'months'] } },
    restrict_delay: { c: SettingSwitch },
    max_delay: { c: SettingInputNumber, depends: 'restrict_delay' }
  },
  [QUESTION_TYPE_RATING_SCORE]: {
    ...COMMON_SETTINGS,
    label_left: { c: SettingInput },
    label_middle: { c: SettingInput },
    label_right: { c: SettingInput }
  }
}

export const SETTING_TITLE = {
  required: 'Is question required?',
  allow_multiple_selection: 'Multiple selection possble?',
  allow_other_choice: 'Include "other" answer option',
  randomize: 'Randomize answer options?',
  period: 'Period selector',
  restrict_delay: 'Restrict maximum time delay',
  max_delay: 'Max delay in days',
  label_left: 'Label left',
  label_right: 'Label right',
  label_middle: 'Label middle',
  from: 'From',
  to: 'To'
}
