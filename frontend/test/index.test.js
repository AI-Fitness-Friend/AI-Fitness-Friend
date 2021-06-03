// https://github.com/jsdom/jsdom#executing-scripts

import { fireEvent, getByText } from '@testing-library/dom'
import '@testing-library/jest-dom/extend-expect'
import { JSDOM } from 'jsdom'
import fs from 'fs'
import path from 'path'

const html = fs.readFileSync(path.resolve(__dirname, '../index.html'), 'utf8');

let dom
let container

describe('index.html', () => {
  
  // common one
  beforeEach(() => {
    dom = new JSDOM(html, { runScripts: 'dangerously' })
    container = dom.window.document.body
  })


  // checks if h2 is null, if it is null, it arises
  it('renders a heading 2 element', () => {
    expect(container.querySelector('h2')).not.toBeNull()
    
    // h2 content
    expect(getByText(container, 'Please pick the desired workout category.')).toBeInTheDocument()
  })


  // checks if h4 is null, if it is null, it arises
  it('renders a button element', () => {
    // h4
    expect(container.querySelector('h4')).not.toBeNull()
  })

})


