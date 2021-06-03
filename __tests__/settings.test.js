// https://github.com/jsdom/jsdom#executing-scripts

import { fireEvent, getByText } from '@testing-library/dom'
import '@testing-library/jest-dom/extend-expect'
import { JSDOM } from 'jsdom'
import fs from 'fs'
import path from 'path'

const html = fs.readFileSync(path.resolve(__dirname, '../settings.html'), 'utf8');

let dom
let container

describe('settings.html', () => {
  // common one
  beforeEach(() => {
    dom = new JSDOM(html, { runScripts: 'dangerously' })
    container = dom.window.document.body
  })


  // Checks if h1 is not null at the same time it has certain text
  it('renders a heading 1 element', () => {
    expect(container.querySelector('h1')).not.toBeNull()
    expect(getByText(container, 'Settings')).toBeInTheDocument()
  })

  
})