import { QUESTION_TYPE_YES_NO } from '@/constants/Forms/questions'
import { v4 as uuid } from 'uuid'
import axios from 'axios'

export function updateArrayElement (array, index, updates) {
  return array.map((el, i) => i === index
    ? typeof updates === 'function' ? updates(el) : { ...el, ...updates }
    : el
  )
}

export function injectIntoString (str, pos, subject) {
  const strArr = str.split('')
  return [...strArr.slice(0, pos), subject, ...strArr.slice(pos)].join('')
}

export function recursivelyGetProp (obj, path) {
  return path.reduce((acc, curr) => acc[curr], obj)
}

export const merge = (target, source) => {
  target = ((obj) => {
    let cloneObj
    try {
      cloneObj = JSON.parse(JSON.stringify(obj))
    } catch (err) {
      // If the stringify fails due to circular reference, the merge defaults
      //   to a less-safe assignment that may still mutate elements in the target.
      // You can change this part to throw an error for a truly safe deep merge.
      cloneObj = Object.assign({}, obj)
    }
    return cloneObj
  })(target)

  const isObject = (obj) => obj && typeof obj === 'object'

  if (!isObject(target) || !isObject(source)) { return source }

  Object.keys(source).forEach(key => {
    const targetValue = target[key]
    const sourceValue = source[key]

    if (Array.isArray(targetValue)) {
      target[key] = targetValue.map((x, i) => sourceValue[i]
        ? merge(x, sourceValue[i])
        : x)
    } else if (isObject(targetValue) && isObject(sourceValue)) { target[key] = merge(Object.assign({}, targetValue), sourceValue) } else { target[key] = sourceValue }
  })

  return target
}

export function filterFormQuestions (form, omitTypes) {
  return {
    ...form,
    kick_offs: form.kick_offs.filter(q => omitTypes.indexOf(q.type) === -1),
    follow_ups: form.follow_ups.filter(q => omitTypes.indexOf(q.type) === -1)
  }
}

export function shuffle (array) {
  const newArray = array.slice()
  for (let i = newArray.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [newArray[i], newArray[j]] = [newArray[j], newArray[i]]
  }
  return newArray
}

export function injectDefaultPreReviewYesNo (data) {
  return {
    ...(data || {}),
    kick_offs: [{
      type: QUESTION_TYPE_YES_NO,
      title: 'Are you ready to review your recent purchases?',
      id: uuid(),
      properties: {
        choices: [
          { label: 'Yes', id: uuid() },
          { label: 'No', id: uuid() }
        ]
      }
    }]
  }
}

export async function uploadFile (file, catalog, storeId) {
  const r = await window.Vapor.store(file, { visibility: 'public-read' })
  const { data } = await axios.post(route('api.files.store'), {
    path: r.key,
    contentType: file.type,
    extension: r.extension,
    catalog: catalog
  }, {
    headers: { 'X-Store-Id': storeId }
  })
  return data.path
}

export function delay (ms) {
  return new Promise(resolve => {
    setTimeout(() => resolve(), ms)
  })
}

export function compare (a, op, b) {
  switch (op) {
    case '==':
      return a === b
    case '!=':
      return a !== b
    case '>':
      return a > b
    case '<':
      return a < b
    case '>=':
      return a >= b
    case '<=':
      return a <= b
    default:
      return false
  }
}
