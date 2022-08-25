import QuestionSettings from './../../Components/FormBuilder/QuestionSettings'
import LogicJump from './../../Components/FormBuilder/LogicJump'
import FormTransfer from './../../Components/FormBuilder/FormTransfer'
import AddEmoji from './../../Components/FormBuilder/AddEmoji'
import Hyperlink from './../../Components/FormBuilder/Hyperlink'
import RecallInfo from './../../Components/FormBuilder/RecallInfo'
import MergeTags from './../../Components/FormBuilder/MergeTags'
import StoreAnswer from './../../Components/FormBuilder/StoreAnswer'
import { markRaw } from 'vue'
import DesignTheme from './../../Components/FormBuilder/DesignTheme'
import Canvas from './../../Components/FormBuilder/Canvas'

export const QUESTION_SETTINGS = 'question_settings'
export const LOGIC_JUMP = 'logic_jump'
export const FORM_TRANSFER = 'form_transfer'
export const ADD_EMOJI = 'add_emoji'
export const HYPERLINK = 'hyperlink'
export const RECALL_INFO = 'recall_info'
export const MERGE_TAGS = 'merge_tags'
export const STORE_ANSWER = 'store_answer'
export const DESIGN_THEME = 'design_theme'
export const CANVAS = 'canvas'

export const CENTRAL_PART_COMPONENTS = [
  QUESTION_SETTINGS,
  LOGIC_JUMP,
  FORM_TRANSFER,
  ADD_EMOJI,
  HYPERLINK,
  RECALL_INFO,
  MERGE_TAGS,
  STORE_ANSWER,
  CANVAS
]

export const componentByName = {
  QuestionSettings: markRaw(QuestionSettings),
  LogicJump: markRaw(LogicJump),
  FormTransfer: markRaw(FormTransfer),
  AddEmoji: markRaw(AddEmoji),
  Hyperlink: markRaw(Hyperlink),
  RecallInfo: markRaw(RecallInfo),
  MergeTags: markRaw(MergeTags),
  StoreAnswer: markRaw(StoreAnswer),
  DesignTheme: markRaw(DesignTheme),
  Canvas: markRaw(Canvas)
}

export const componentMap = {
  [QUESTION_SETTINGS]: () => componentByName.QuestionSettings,
  [LOGIC_JUMP]: () => componentByName.LogicJump,
  [FORM_TRANSFER]: () => componentByName.FormTransfer,
  [ADD_EMOJI]: () => componentByName.AddEmoji,
  [HYPERLINK]: () => componentByName.Hyperlink,
  [RECALL_INFO]: () => componentByName.RecallInfo,
  [MERGE_TAGS]: () => componentByName.MergeTags,
  [STORE_ANSWER]: () => componentByName.StoreAnswer,
  [DESIGN_THEME]: () => componentByName.DesignTheme,
  [CANVAS]: () => componentByName.Canvas
}
