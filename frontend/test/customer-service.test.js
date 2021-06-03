// https://github.com/jsdom/jsdom#executing-scripts

import { fireEvent, getByText } from '@testing-library/dom'
import '@testing-library/jest-dom/extend-expect'
import { JSDOM } from 'jsdom'
import fs from 'fs'
import path from 'path'

const html = fs.readFileSync(path.resolve(__dirname, '../customer-service.html'), 'utf8');

let dom
let container

describe('customer-service.html', () => {
  // common one
  beforeEach(() => {
    dom = new JSDOM(html, { runScripts: 'dangerously' })
    container = dom.window.document.body
  })


  // Checks if h3 is not null at the same time it has certain text
  it('renders a heading 3 element', () => {
    expect(container.querySelector('h3')).not.toBeNull()
    
  })

  // Checks if h1 is not null at the same time it has certain text
  it('renders a heading 3 element', () => {
    expect(container.querySelector('h1')).not.toBeNull()
    
  })
  
})