import { QUESTION_TYPE_RATING_SCORE } from './questions'

export const FORM_CATEGORY_PRE_REVIEW = 'pre_review'
export const FORM_CATEGORY_REVIEW = 'review'

export const FORM_TYPE_PRODUCT = 'products'
export const FORM_TYPE_COMPANY = 'company'

export const FORM_CATEGORY_TITLE = {
  [FORM_CATEGORY_PRE_REVIEW]: 'Pre-Review',
  [FORM_CATEGORY_REVIEW]: 'Review'
}

export const formCategoryTitle = c => FORM_CATEGORY_TITLE[c] || c

export const UNAVAILABLE_QUESTIONS_BY_FORM_CATEGORY = {
  [FORM_CATEGORY_REVIEW]: [],
  [FORM_CATEGORY_PRE_REVIEW]: [QUESTION_TYPE_RATING_SCORE]
}

export const PREVIEW_TYPE_QUESTION = 'question'
export const PREVIEW_TYPE_FORM = 'form'
