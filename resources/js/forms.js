import { validate } from 'uuid'

export function mergeTags (string, tags) {
  return string && string.replace(/{{ .+? }}/g, match => {
    return tags[match.replace(/[{} ]/g, '')] || ''
  })
}

export function recallInfo (string, answers) {
  return string && string.replace(/\[Recall info = answer to [K|F]OQ-(\d+)\]|{{.+?}}/g, (match, questionIndex) => {
    let indexIncrementor = 0
    return answers
      .filter(a => {
        if (validate(a.questionId)) {
          return true
        }
        indexIncrementor++
        return false
      })
      .filter(a => (a.index - indexIncrementor + 1) === parseInt(questionIndex)).slice(-1)[0]
      ?.answers?.map(a => a.value).join(' ') || ''
  })
}
